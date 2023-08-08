<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Language extends Model
{
    use HasFactory, HasTranslations;


    public $translatable = [
        'name',
    ];

    protected $fillable = [
        'name',
        'code',
        'encoding',
        'image',
        'is_default',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if ($model->is_default == 1) {
                Language::where('is_default', 1)
                    ->where('id','<>', $model->id)
                    ->update(['is_default' => 0]);
            }
        });
    }

    public function scopeOrderByName($query)
    {
        $query->orderBy('name');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->whereRaw('lower(name) like lower(?)', ["%{$search}%"]);
            });
        });
    }

    public function scopeIsDefault($query)
    {
        $query->whereIsDefault(1);
    }

    public function scopeIsNotDefault($query)
    {
        $query->whereIsDefault(0);
    }

    public function scopeActive($query)
    {
        $query->whereStatus(1);
    }
}
