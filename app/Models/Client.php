<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory,
        SoftDeletes;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'status',
        'creater',
        'updater',
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
                ->orWhereRaw('lower(phone) like lower(?)', ["%{$search}%"])
                ->orWhereRaw('lower(email) like lower(?)', ["%{$search}%"]);
            });
        });
    }

    public function scopeActive($query)
    {
        $query->where('status', 1);
    }

}
