@extends('admin.layout.app')

@section('title', 'Edit FAQ Item')
@section('page_title', 'Edit FAQ Question')
@section('page_subtitle', 'Update question details, category, and display order.')

@section('styles')
<style>
    :root {
        --primary: #2E6BE6;
        --dark: #0f172a;
        --gray: #64748b;
        --border: #e2e8f0;
        --danger: #ef4444;
    }

    .form-container {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        max-width: 900px;
        margin: 0 auto;
        border: 1px solid var(--border);
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: var(--dark);
        font-size: 0.875rem;
    }

    .form-group label .required {
        color: var(--danger);
    }

    .form-control {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1.5px solid var(--border);
        border-radius: 12px;
        font-size: 0.95rem;
        outline: none;
        transition: border-color 0.2s;
    }
    .form-control:focus {
        border-color: var(--primary);
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid var(--border);
    }

    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        border: none;
        font-size: 0.9rem;
    }
    .btn-secondary {
        background: #f1f5f9;
        color: var(--gray);
    }
    .btn-primary {
        background: var(--primary);
        color: white;
    }
    .btn-primary:hover {
        background: #1e40af;
    }

    .checkbox-wrap {
        display: flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
    }
    .checkbox-wrap input {
        width: 18px;
        height: 18px;
        accent-color: var(--primary);
    }
</style>
@endsection

@section('content')

<div class="form-container">
    <form action="{{ route('admin.faqs.update', $faq->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Question --}}
        <div class="form-group">
            <label for="question">Question <span class="required">*</span></label>
            <input type="text" name="question" id="question" class="form-control" placeholder="e.g. How do I track my airport transfer?" value="{{ old('question', $faq->question) }}" required>
            @error('question')
                <span style="color: var(--danger); font-size: 0.8rem; margin-top: 4px; display: block;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-row">
            {{-- Category --}}
            <div class="form-group">
                <label for="category">Category <span class="required">*</span></label>
                <input type="text" name="category" id="category" class="form-control" list="categoryList" placeholder="e.g. Booking & Fares, Airport Pickups" value="{{ old('category', $faq->category) }}" required>
                <datalist id="categoryList">
                    <option value="General">
                    <option value="Booking & Fares">
                    <option value="Airport Pickups">
                    <option value="Vehicles & Luggage">
                    <option value="Payments & Cancellations">
                    @foreach($existingCategories as $cat)
                        <option value="{{ $cat }}">
                    @endforeach
                </datalist>
            </div>

            {{-- Sort Order --}}
            <div class="form-group">
                <label for="sort_order">Display Sort Order</label>
                <input type="number" name="sort_order" id="sort_order" class="form-control" placeholder="0" value="{{ old('sort_order', $faq->sort_order) }}">
                <span style="font-size: 0.75rem; color: var(--gray);">Lower numbers appear first.</span>
            </div>
        </div>

        {{-- Answer --}}
        <div class="form-group">
            <label for="answer">Answer Content <span class="required">*</span></label>
            <textarea name="answer" id="editor" class="form-control" rows="6" placeholder="Write the detailed answer here...">{{ old('answer', $faq->answer) }}</textarea>
            @error('answer')
                <span style="color: var(--danger); font-size: 0.8rem; margin-top: 4px; display: block;">{{ $message }}</span>
            @enderror
        </div>

        {{-- Status --}}
        <div class="form-group">
            <label class="checkbox-wrap">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $faq->is_active) ? 'checked' : '' }}>
                <span>Active / Published on Website</span>
            </label>
        </div>

        {{-- Form Actions --}}
        <div class="form-actions">
            <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i> Cancel
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Update FAQ Item
            </button>
        </div>
    </form>
</div>

@endsection

@section('scripts')
<script src="https://cdn.tiny.cloud/1/{{ env('TINYMCE_API_KEY') }}/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#editor',
        height: 250,
        menubar: false,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'charmap', 'preview',
            'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'table', 'wordcount'
        ],
        toolbar: 'undo redo | blocks | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | link removeformat | code',
        content_style: 'body { font-family: Inter, Helvetica, Arial, sans-serif; font-size: 14px; color: #1e293b; line-height: 1.5; }',
        branding: false,
        promotion: false,
        setup: function (editor) {
            editor.on('change', function () {
                editor.save();
            });

            editor.on('init', function () {
                editor.save();
            });
        }
    });

    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector("form[action='{{ route('admin.faqs.update', $faq->id) }}']");
        if (!form) return;

        form.addEventListener('submit', function (event) {
            const editor = tinymce.get('editor');
            if (editor) {
                editor.save();
            }

            const answer = form.querySelector('textarea[name="answer"]');
            if (answer && !answer.value.trim()) {
                event.preventDefault();
                alert('Please enter an answer before saving the FAQ.');
                return;
            }
        });
    });
</script>
@endsection
