<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Calculation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'rate_14',
        'rate_30',
        'rate_60',
        'rate_other',
        'rate_one_time',
        'creater',
        'updater',
    ];


    protected static function booted()
    {
        static::creating(function ($сalculation) {
            $сalculation->creater_id = Auth::id();
            $сalculation->creater = Auth::user()->name;
            $сalculation->updater = Auth::user()->name;
        });

        static::updating(function ($сalculation) {
            $сalculation->updater = Auth::user()->name;
        });
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->whereRaw('lower(name) like lower(?)', ["%{$search}%"]);
            });
        });
    }
}
