<?php
declare(strict_types=1);

namespace App\Models;

use App\Jobs\SendMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Car extends Model
{
    use HasFactory,
        SoftDeletes;

    const STATUSES_OF_FILLING_IMAGES = ['BOTH', 'ON', 'OUT'];
    const NO_STATUS = 'NO';

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
        'comment',
        'client_id',
        'payment_summa',
        'user_clicked_payment_status',
        'paymented_at',
        'payment_status',
    ];

    protected $casts = [
        'containerImages' => 'array',
        'terminalImages' => 'array',
        'outImages' => 'array',
    ];

    protected static function booted()
    {
        if (Auth::check()) {
            static::creating(function ($car) {
                $car->creater = Auth::user()->name;
                $car->updater = Auth::user()->name;
            });

            static::updating(function ($car) {
                $car->updater = Auth::user()->name;
            });
        }

        static::saved(function ($car) {

            $type = $car->wasChanged('terminalImages') && $car->wasChanged('outImages')
                ? self::STATUSES_OF_FILLING_IMAGES[0]
                : ( $car->wasChanged('terminalImages')
                    ? self::STATUSES_OF_FILLING_IMAGES[1]
                    : ($car->wasChanged('outImages')
                        ? self::STATUSES_OF_FILLING_IMAGES[2]
                        : self::NO_STATUS)
                );

            if (in_array($type, self::STATUSES_OF_FILLING_IMAGES)) {
                if ($type=== self::STATUSES_OF_FILLING_IMAGES[1]) {
                    $text = sprintf(__('mail.bodytext_on_terminal'), $car->vin, $car->name);
                } elseif ($type === self::STATUSES_OF_FILLING_IMAGES[2]) {
                    $text = sprintf(__('mail.bodytext_out_terminal'), $car->vin, $car->name);
                } else {
                    $text = sprintf(__('mail.bodytext_on_terminal'), $car->vin, $car->name);
                    SendMail::dispatch($text);
                    $text = sprintf(__('mail.bodytext_out_terminal'), $car->vin, $car->name);
                    SendMail::dispatch($text);
                }
                SendMail::dispatch($text);
            }
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

    public function scopeActive($query)
    {
            $query->where('status',1);
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
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
