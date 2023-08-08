<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = [
        'address',
    ];

    protected $fillable = [
        'name',
        'logo',
        'address',
        'phone',
        'phone_driver',
        'email',
        'google_map_link',
        'video',
    ];
}
