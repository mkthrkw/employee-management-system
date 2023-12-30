<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class BcRoute extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'display_memo1',
        'display_memo2',
        'display_memo3',
        'memo',
    ];


    /**
     * 1(HasMany) to Many : relation table
     *
     *
     */
    public function mailing_lists(): HasMany
    {
        return $this->hasMany(MailingList::class);
    }

    public function accounts(): HasMany
    {
        return $this->hasMany(Account::class);
    }


    /**
     * Many to Many : relation table
     *
     *
     */
    public function bc_authorizers(): BelongsToMany
    {
        return $this->belongsToMany(Account::class);
    }
}
