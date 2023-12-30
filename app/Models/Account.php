<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use App\Enums\AccountStatus;
use App\Enums\Position;
use App\Enums\Role;

class Account extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'status',
        'employee_number',
        'name',
        'name_kana',
        'position',
        'email',
        'bc_route_id',
        'windows_username',
        'chatwork_aid',
        'role',
        'password',
        'joining_date',
        'leaving_date',
        'memo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status'    => AccountStatus::class,
        'position'  => Position::class,
        'role'      => Role::class,
    ];


    /**
     * 1(HasMany) to Many : relation table
     *
     *
     */
    public function desktop_pcs(): HasMany
    {
        return $this->hasMany(DesktopPc::class);
    }

    public function laptop_pcs(): HasMany
    {
        return $this->hasMany(LaptopPc::class);
    }

    public function mobile_phones(): HasMany
    {
        return $this->hasMany(MobilePhone::class);
    }


    /**
     * 1 to Many(BelongsTo) : relation table
     *
     *
     */
    public function bc_route(): BelongsTo
    {
        return $this->belongsTo(BcRoute::class);
    }


    /**
     * Many to Many : relation table
     *
     *
     */
    public function departments(): BelongsToMany
    {
        return $this->belongsToMany(Department::class);
    }

    public function mailing_lists(): BelongsToMany
    {
        return $this->belongsToMany(MailingList::class);
    }

    public function bc_authroutes(): BelongsToMany
    {
        return $this->belongsToMany(BcRoute::class);
        // return $this->belongsToMany(BcRoute::class,'account_bc_route','account_id','bc_route_id','id','id','bc_routes');
    }
}
