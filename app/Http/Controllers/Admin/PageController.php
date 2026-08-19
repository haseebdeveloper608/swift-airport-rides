<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\about;
use App\Models\Pages as Homepage;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;


class PageController extends Controller
{
    public function index()
    {
        $pages = Homepage::orderBy('name')->get();

        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.inner.create');
    }

    public function edit($id)
    {
        $homepage = Homepage::findOrFail($id);

        $sectionsEnabled = $homepage->sections_enabled ?? [];

        return view('admin.pages.inner.edit', compact('homepage', 'sectionsEnabled'));
    }

    public function store(Request $request)
    {
        try {
            $homepage = new Homepage();

            $payload = $this->normalizePayload($request);

            $homepage->fill($payload);
            $homepage->save();

            if ($request->expectsJson() || $request->ajax() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
                return response()->json([
                    'success' => true,
                    'message' => 'Page created successfully.',
                    'page_id' => $homepage->id,
                    'redirect' => route('admin.pages.edit', $homepage->id),
                ]);
            }

            return redirect()
                ->route('admin.pages.index')
                ->with('success', 'Page created successfully.');
        } catch (\Exception $e) {
            if ($request->expectsJson() || $request->ajax() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
                return response()->json([
                    'success' => false,
                    'message' => 'Error saving page: ' . $e->getMessage(),
                ], 400);
            }

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error saving page: ' . $e->getMessage());
        }
    }

    public function update(Request $request)
    {
        try {
            $id = $request->input('id');
            $homepage = Homepage::findOrFail($id);

            $payload = $this->normalizePayload($request, $homepage);

            $homepage->fill($payload);
            $homepage->save();

            if ($request->expectsJson() || $request->ajax() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
                return response()->json([
                    'success' => true,
                    'message' => 'Page updated successfully.',
                    'page_id' => $homepage->id,
                ]);
            }

            return redirect()
                ->route('admin.pages.index')
                ->with('success', 'Page updated successfully.');
        } catch (\Exception $e) {
            if ($request->expectsJson() || $request->ajax() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
                return response()->json([
                    'success' => false,
                    'message' => 'Error updating page: ' . $e->getMessage(),
                ], 400);
            }

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error updating page: ' . $e->getMessage());
        }
    }

    public function duplicate(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'slug'  => 'required|string|max:255|unique:pages,slug',
            ]);

            $title = trim($request->input('title'));
            $rawSlug = trim($request->input('slug'));
            $slug = \Illuminate\Support\Str::slug($rawSlug ?: $title);

            $sourceType = $request->input('source_type', 'homepage');
            $sourceId   = $request->input('source_id');

            if ($sourceType === 'homepage') {
                $source = WebsiteSetting::first();

                if (!$source) {
                    return redirect()->back()->with('error', 'Homepage settings could not be found to duplicate.');
                }

                $pageColumns = Schema::getColumnListing('pages');
                $data = array_intersect_key($source->toArray(), array_flip($pageColumns));
            } else {
                $source = !empty($sourceId) ? Homepage::find($sourceId) : null;

                if (!$source) {
                    return redirect()->back()->with('error', 'The selected page could not be found to duplicate.');
                }

                $data = $source->toArray();
            }

            unset($data['id'], $data['created_at'], $data['updated_at']);

            $data['name'] = $title;
            $data['slug'] = $slug;

            $newPage = Homepage::create($data);

            return redirect()
                ->route('admin.pages.index')
                ->with('success', 'Page "' . $title . '" duplicated successfully!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error duplicating page: ' . $e->getMessage());
        }
    }

    protected function normalizePayload(Request $request, ?Homepage $homepage = null): array
    {
        $name = $this->normalizeTextValue($request->input('name')) ?: ($homepage->name ?? 'Untitled Page');
        $rawSlug = $this->normalizeTextValue($request->input('slug'));
        $slug = $rawSlug ? \Illuminate\Support\Str::slug($rawSlug) : \Illuminate\Support\Str::slug($name);

        $data = [
            'name' => $name,
            'slug' => $slug,

            'hero_title' => $this->normalizeTextValue($request->input('hero_title')),
            'hero_subtitle' => $this->normalizeTextValue($request->input('hero_subtitle')),

            'trust_strip' => $this->toArray($request->input('trust_strip')),

            'ticker_label' => $this->normalizeTextValue($request->input('ticker_label')),
            'ticker_items' => $this->toArray($request->input('ticker_items')),

            'rideon_heading' => $this->normalizeTextValue($request->input('rideon_heading')),
            'rideon_paragraph_1' => $this->normalizeTextValue($request->input('rideon_paragraph_1')),
            'rideon_paragraph_2' => $this->normalizeTextValue($request->input('rideon_paragraph_2')),
            'rideon_bullets' => $this->toArray($request->input('rideon_bullets')),
            'rideon_cta_text' => $this->normalizeTextValue($request->input('rideon_cta_text')),
            'rideon_cta_link' => $this->normalizeTextValue($request->input('rideon_cta_link')),

            'services_eyebrow' => $this->normalizeTextValue($request->input('services_eyebrow')),
            'services_heading' => $this->normalizeTextValue($request->input('services_heading')),
            'services_subheading' => $this->normalizeTextValue($request->input('services_subheading')),
            'services' => $this->toArray($request->input('services')),

            'fleet_eyebrow' => $this->normalizeTextValue($request->input('fleet_eyebrow')),
            'fleet_heading' => $this->normalizeTextValue($request->input('fleet_heading')),
            'fleet_subheading' => $this->normalizeTextValue($request->input('fleet_subheading')),
            'fleet_vehicles' => $this->normalizeFleetVehicles($request),

            'why_eyebrow' => $this->normalizeTextValue($request->input('why_eyebrow')),
            'why_heading' => $this->normalizeTextValue($request->input('why_heading')),
            'why_features' => $this->toArray($request->input('why_features')),
            'why_rating_value' => $this->normalizeTextValue($request->input('why_rating_value')),
            'why_rating_description' => $this->normalizeTextValue($request->input('why_rating_description')),
            'why_mini_stats' => $this->toArray($request->input('why_mini_stats')),

            'highlight_icon' => $this->normalizeTextValue($request->input('highlight_icon')),
            'highlight_heading' => $this->normalizeTextValue($request->input('highlight_heading')),
            'highlight_description' => $this->normalizeTextValue($request->input('highlight_description')),
            'highlight_mini_boxes' => $this->toArray($request->input('highlight_mini_boxes')),
            'highlight_section_title' => $this->normalizeTextValue($request->input('highlight_section_title')),
            'highlight_section_text' => $this->normalizeTextValue($request->input('highlight_section_text')),
            'highlight_feature_list' => $this->toArray($request->input('highlight_feature_list')),
            'highlight_cta_text' => $this->normalizeTextValue($request->input('highlight_cta_text')),
            'highlight_cta_link' => $this->normalizeTextValue($request->input('highlight_cta_link')),
            'highlight_about_heading' => $this->normalizeTextValue($request->input('highlight_about_heading')),
            'highlight_about_text' => $this->normalizeTextValue($request->input('highlight_about_text')),

            'cta_heading' => $this->normalizeTextValue($request->input('cta_heading')),
            'cta_description' => $this->normalizeTextValue($request->input('cta_description')),
            'cta_primary_button_text' => $this->normalizeTextValue($request->input('cta_primary_button_text')),
            'cta_primary_button_link' => $this->normalizeTextValue($request->input('cta_primary_button_link')),
            'cta_secondary_button_text' => $this->normalizeTextValue($request->input('cta_secondary_button_text')),
            'cta_secondary_button_link' => $this->normalizeTextValue($request->input('cta_secondary_button_link')),

            'testimonials_eyebrow' => $this->normalizeTextValue($request->input('testimonials_eyebrow')),
            'testimonials_heading' => $this->normalizeTextValue($request->input('testimonials_heading')),
            'testimonials_subheading' => $this->normalizeTextValue($request->input('testimonials_subheading')),
            'testimonials' => $this->toArray($request->input('testimonials')),

            'faq_eyebrow' => $this->normalizeTextValue($request->input('faq_eyebrow')),
            'faq_heading' => $this->normalizeTextValue($request->input('faq_heading')),
            'faq_subheading' => $this->normalizeTextValue($request->input('faq_subheading')),
            'faqs' => $this->toArray($request->input('faqs')),

            'contact_eyebrow' => $this->normalizeTextValue($request->input('contact_eyebrow')),
            'contact_heading' => $this->normalizeTextValue($request->input('contact_heading')),
            'contact_description' => $this->normalizeTextValue($request->input('contact_description')),
            'contact_email' => $this->normalizeTextValue($request->input('contact_email')),
            'contact_location' => $this->normalizeTextValue($request->input('contact_location')),

            'sections_enabled' => $this->toArray($request->input('sections_enabled')),

            'seo_title' => $this->normalizeTextValue($request->input('seo_title')),
            'seo_description' => $this->normalizeTextValue($request->input('seo_description')),
            'seo_meta_keywords' => $this->normalizeTextValue($request->input('seo_meta_keywords')),
            'seo_schema_markup' => $this->normalizeTextValue($request->input('seo_schema_markup')),
        ];

        foreach ([
            'hero_badge_text', 'hero_title_line1', 'hero_title_line2', 'hero_title_gradient_text',
            'hero_description', 'hero_form_discount_text', 'hero_form_submit_text', 'hero_form_note_text',
            'services_label', 'services_heading_line1', 'services_heading_line2', 'services_heading_gradient',
            'services_description', 'services_button_text', 'about_badge', 'about_heading_line1',
            'about_heading_line2', 'about_description', 'about_experience_years', 'about_experience_text',
            'about_button_text', 'about_button_link', 'airports_label', 'airports_heading_line1',
            'airports_heading_line2', 'airports_view_all_text', 'coverage_label', 'coverage_heading_line1',
            'coverage_heading_line2', 'coverage_description', 'coverage_button_text', 'coverage_float_card_title',
            'coverage_float_card_route', 'coverage_float_card_price', 'coverage_float_card_price_text',
            'fleet_label', 'fleet_heading', 'fleet_subheading', 'fleet_view_all_text', 'story_label',
            'story_heading_line1', 'story_heading_line2', 'story_paragraph1', 'story_paragraph2',
            'reviews_label', 'reviews_heading', 'reviews_description', 'faq_label', 'faq_heading',
            'faq_description', 'meta_title', 'meta_description', 'meta_keywords', 'meta_og_image',
            'schema_type', 'schema_org_name', 'schema_org_url', 'schema_org_logo', 'schema_org_phone',
            'schema_org_email', 'schema_business_street', 'schema_business_city', 'schema_business_state',
            'schema_business_postal', 'schema_business_country', 'schema_social_profiles', 'schema_custom_json',
        ] as $field) {
            $data[$field] = $this->normalizeTextValue($request->input($field));
        }

        foreach (['hero_benefits', 'stats', 'services_list', 'about_checkmarks', 'airports_list', 'story_values', 'reviews_list', 'faq_list'] as $field) {
            $data[$field] = $this->toArray($request->input($field));
        }

        foreach (['reviews_enabled', 'faq_enabled', 'schema_enabled'] as $field) {
            $data[$field] = $request->boolean($field);
        }

        foreach (['hero_background_image', 'about_image', 'story_image', 'coverage_map_image', 'coverage_background_image'] as $field) {
            $file = $request->file($field . '_file') ?: $request->file($field);
            if ($file) {
                $oldPath = $homepage?->getAttribute($field);
                if ($oldPath) {
                    Storage::disk('public')->delete(str_replace('storage/', '', ltrim($oldPath, '/')));
                }
                $data[$field] = 'storage/' . $file->store('pages', 'public');
            } else {
                $data[$field] = $this->normalizeTextValue($request->input($field)) ?: ($homepage?->getAttribute($field));
            }
        }

        $data = array_intersect_key($data, array_flip(Schema::getColumnListing('pages')));

        if ($request->hasFile('rideon_image')) {

            if ($homepage && $homepage->rideon_image) {
                $old = str_replace('storage/', '', $homepage->rideon_image);

                if (Storage::disk('public')->exists($old)) {
                    Storage::disk('public')->delete($old);
                }
            }

            $path = $request->file('rideon_image')->store('homepage', 'public');
            $data['rideon_image'] = 'storage/' . $path;

        } elseif ($homepage) {

            $data['rideon_image'] = $homepage->rideon_image;
        }

        return $data;
    }

    protected function normalizeFleetVehicles(Request $request): array
    {
        $items = $this->toArray($request->input('fleet_vehicles'));

        foreach ($items as $index => $item) {

            $image = $item['image'] ?? '';

            if ($request->hasFile("fleet_vehicles.$index.image_upload")) {

                if (!empty($image)) {

                    $old = str_replace('storage/', '', $image);

                    if (Storage::disk('public')->exists($old)) {
                        Storage::disk('public')->delete($old);
                    }
                }

                $path = $request->file("fleet_vehicles.$index.image_upload")
                    ->store('homepage', 'public');

                $image = 'storage/' . $path;
            }

            $item['image'] = $image;

            $items[$index] = $this->normalizeTextValue($item);
        }

        return $items;
    }

    protected function normalizeTextValue($value)
    {
        if (is_array($value)) {
            foreach ($value as $key => $item) {
                $value[$key] = $this->normalizeTextValue($item);
            }

            return $value;
        }

        if (!is_string($value)) {
            return $value;
        }

        $value = preg_replace('/<p[^>]*>/i', '', $value);
        $value = preg_replace('/<\/p>/i', '', $value);
        $value = preg_replace('/<br\s*\/?>/i', "\n", $value);

        return trim($value);
    }

    protected function toArray($value): array
    {
        if (is_array($value)) {
            return $this->normalizeTextValue($value);
        }

        if (is_string($value)) {

            $decoded = json_decode($value, true);

            return is_array($decoded)
                ? $this->normalizeTextValue($decoded)
                : [];
        }

        return [];
    }

    public function destroy($id)
    {
        $page = Homepage::findOrFail($id);

        if ($page->rideon_image) {

            $path = str_replace('storage/', '', $page->rideon_image);

            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }

        if (is_array($page->fleet_vehicles)) {

            foreach ($page->fleet_vehicles as $vehicle) {

                if (!empty($vehicle['image'])) {

                    $path = str_replace('storage/', '', $vehicle['image']);

                    if (Storage::disk('public')->exists($path)) {
                        Storage::disk('public')->delete($path);
                    }
                }
            }
        }

        $page->delete();

        return redirect()
            ->route('admin.pages.index')
            ->with('success', 'Page deleted successfully.');
    }

    public function aboutStore(Request $request)
    {
        $aboutPage = about::first() ?? new about();

        $data = $request->validate([
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string'],
            'seo_keywords' => ['nullable', 'string', 'max:255'],
            'hero_heading' => ['nullable', 'string', 'max:255'],
            'hero_subtitle' => ['nullable', 'string'],
            'hero_tag' => ['nullable', 'string', 'max:255'],
            'hero_highlight_text' => ['nullable', 'string', 'max:255'],
            'hero_quote_text' => ['nullable', 'string'],
            'hero_quote_author' => ['nullable', 'string', 'max:255'],
            'story_eyebrow' => ['nullable', 'string', 'max:255'],
            'story_heading' => ['nullable', 'string', 'max:255'],
            'story_paragraph_1' => ['nullable', 'string'],
            'story_paragraph_2' => ['nullable', 'string'],
            'story_badge_text' => ['nullable', 'string', 'max:255'],
            'values_eyebrow' => ['nullable', 'string', 'max:255'],
            'values_heading' => ['nullable', 'string', 'max:255'],
            'mission_eyebrow' => ['nullable', 'string', 'max:255'],
            'mission_heading' => ['nullable', 'string'],
            'mission_description' => ['nullable', 'string'],
            'cta_heading' => ['nullable', 'string', 'max:255'],
            'cta_subheading' => ['nullable', 'string', 'max:255'],
            'cta_phone_label' => ['nullable', 'string', 'max:255'],
            'cta_phone_number' => ['nullable', 'string', 'max:255'],
            'cta_button_text' => ['nullable', 'string', 'max:255'],
            'cta_button_url' => ['nullable', 'string', 'max:255'],
            'story_pillars' => ['nullable', 'array'],
            'stats' => ['nullable', 'array'],
            'values' => ['nullable', 'array'],
            'hero_quote_visible' => ['sometimes', 'boolean'],
            'stats_visible' => ['sometimes', 'boolean'],
            'values_visible' => ['sometimes', 'boolean'],
            'mission_visible' => ['sometimes', 'boolean'],
            'cta_visible' => ['sometimes', 'boolean'],
            'is_active' => ['sometimes', 'boolean'],
            'hero_background_image' => ['nullable', 'string', 'max:255'],
            'story_main_image' => ['nullable', 'string', 'max:255'],
            'story_overlap_image' => ['nullable', 'string', 'max:255'],
            'mission_background_image' => ['nullable', 'string', 'max:255'],
            'hero_background_image_file' => ['nullable', 'image', 'max:5120'],
            'story_main_image_file' => ['nullable', 'image', 'max:5120'],
            'story_overlap_image_file' => ['nullable', 'image', 'max:5120'],
            'mission_background_image_file' => ['nullable', 'image', 'max:5120'],
        ]);

        foreach (['hero_background_image', 'story_main_image', 'story_overlap_image', 'mission_background_image'] as $field) {
            $fileField = $field . '_file';
            if ($request->hasFile($fileField)) {
                $oldPath = $aboutPage->getAttribute($field);
                if ($oldPath && !str_starts_with($oldPath, 'http://') && !str_starts_with($oldPath, 'https://')) {
                    Storage::disk('public')->delete(str_replace('storage/', '', ltrim($oldPath, '/')));
                }
                $data[$field] = $request->file($fileField)->store('about', 'public');
            }
        }

        foreach (['hero_quote_visible', 'stats_visible', 'values_visible', 'mission_visible', 'cta_visible', 'is_active'] as $field) {
            $data[$field] = $request->boolean($field);
        }

        $aboutPage->fill($data);
        $aboutPage->save();

        return response()->json(['success' => true, 'message' => 'About page updated successfully']);
    }

    public function aboutShow()
    {
        $aboutPage = about::first();
        return view('admin.pages.inner.about', compact('aboutPage'));
    }
}