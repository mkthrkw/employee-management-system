<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\DeviceStatus;
use App\Enums\Branch;

class LaptopPc extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'account_id',
        'status',
        'name',
        'device_name',
        'cpu',
        'memory',
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
        'status' => DeviceStatus::class,
        'branch' => Branch::class,
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
