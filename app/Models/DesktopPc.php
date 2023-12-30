<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\DeviceStatus;
use App\Enums\CastingNavi;
use App\Enums\Branch;

class DesktopPc extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'account_id',
        'status',
        'name',
        'cpu',
        'memory',
        'hdd',
        'vpn_connection_id',
        'vpn_unique_id',
        'casting_navi',
        'branch',
        'arrival_date',
        'disposal_date',
        'memo',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status'        => DeviceStatus::class,
        'casting_navi'  => CastingNavi::class,
        'branch'        => Branch::class,
    ];


    /**
     * relation table
     *
     *
     */
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
