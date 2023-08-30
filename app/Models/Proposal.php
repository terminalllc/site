<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Proposal extends Model
{
    use
        HasFactory,
        SoftDeletes;

    protected $fillable = [
        'name_car',
        'vin_car',
        'model_tow_track',
        'number_tow_track',
        'number_trailer',
        'name_driver',
        'passport_driver',
        'phone_driver',
        'date_pick_up',
    ];

    protected $casts = [
        'date_pick_up' => 'date:d.m.Y',
    ];
}
