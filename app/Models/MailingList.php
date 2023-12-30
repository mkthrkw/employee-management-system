<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\Branch;

class MailingList extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'address',
        'ext_send_permission',
        'bc_route_id',
        'branch',
        'memo',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'branch' => Branch::class,
    ];


    /**
     * 1 to Many(BelongsTo) : relation table
     *
     *
     */
    public function bc_routes(): BelongsTo
    {
        return $this->belongsTo(BcRoute::class);
    }


    /**
     * Many to Many : relation table
     *
     *
     */
    public function accounts(): BelongsToMany
    {
        return $this->belongsToMany(Account::class);
    }
}
