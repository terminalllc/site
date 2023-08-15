<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'vin',
        'containerImages',
        'terminalImages',
        'outImages',
        'on_terminal_at',
        'out_terminal_at',
        'status',
        'creater',
        'updater',
    ];

    protected $casts = [
        'containerImages' => 'array',
        'terminalImages' => 'array',
        'outImages' => 'array',
    ];

    protected static function booted()
    {
        static::creating(function ($car) {
            $car->creater = Auth::user()->name;
            $car->updater = Auth::user()->name;
        });
        static::updating(function ($car) {
            $car->updater = Auth::user()->name;
        });
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->whereRaw('lower(name) like lower(?)', ["%{$search}%"])
                ->orWhereRaw('lower(vin) like lower(?)', ["%{$search}%"]);
            });
        });
    }

    public function scopeSearch($query, $search)
    {
        $query->when($search, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->whereRaw('LOWER(RIGHT(`vin`,6)) = LOWER(?)', ["{$search}"])
                ->orWhereRaw('lower(vin) = lower(?)', ["{$search}"]);
            });
        });
    }
}
