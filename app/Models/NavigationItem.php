<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NavigationItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'label',
        'url',
        'target',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function parent()
    {
        return $this->belongsTo(NavigationItem::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(NavigationItem::class, 'parent_id')->orderBy('order', 'asc')->with('children');
    }

    public function activeChildren()
    {
        return $this->hasMany(NavigationItem::class, 'parent_id')
            ->where('is_active', true)
            ->orderBy('order', 'asc')
            ->with('activeChildren');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function hasActiveChildren()
    {
        return $this->activeChildren && $this->activeChildren->isNotEmpty();
    }

    public function hasDeepChildren()
    {
        if (!$this->hasActiveChildren()) {
            return false;
        }

        foreach ($this->activeChildren as $child) {
            if ($child->hasActiveChildren()) {
                return true;
            }
        }

        return false;
    }

    public static function getTree()
    {
        self::seedDefaultIfEmpty();

        return self::whereNull('parent_id')
            ->where('is_active', true)
            ->with(['activeChildren.activeChildren'])
            ->orderBy('order', 'asc')
            ->get();
    }

    public static function seedDefaultIfEmpty()
    {
        if (self::count() === 0) {
            $defaultItems = [
                ['label' => 'Home', 'url' => '/', 'order' => 1],
                ['label' => 'Fleet', 'url' => '/#fleet', 'order' => 2],
                ['label' => 'About', 'url' => '/about-us', 'order' => 3],
                ['label' => 'FAQs', 'url' => '/faqs', 'order' => 4],
                ['label' => 'Contact', 'url' => '/contact-us', 'order' => 5],
                ['label' => 'Blog', 'url' => '/blog', 'order' => 6],
            ];

            foreach ($defaultItems as $item) {
                self::create(array_merge($item, [
                    'target' => '_self',
                    'is_active' => true,
                ]));
            }
        }
    }
}
