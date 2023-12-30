<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\DepartmentDepth;

class Department extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'parent_id',
        'depth',
        'memo',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'depth'    => DepartmentDepth::class,
    ];

    /**
     * relation table
     *
     *
     */
    public function accounts(): BelongsToMany
    {
        return $this->belongsToMany(Account::class);
    }


    /**
     * functions
     *
     *
     */
    public function get_parent($department)
    {
        return $this->where('id',$department->parent_id)->first();
    }

    public function get_children($department)
    {
        return $this->where('parent_id',$department->id)->get();
    }

    public function get_members($department)
    {
        return $department->accounts()->get();
    }

    public function get_fullname($department)
    {
        if($department){
            return $this->get_fullname($this->get_parent($department)) . '/' . $department->name;
        }
    }

    public function get_tree($department)
    {
        $department->children = $this->get_children($department);
        $department->members = $this->get_members($department);
        if($department->children){
            foreach($department->children as $child){
                $this->get_tree($child);
            }
        }
        return $department;
    }
}
