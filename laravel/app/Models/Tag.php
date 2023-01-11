<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as SpatieRole;
class Tag extends Model
{
    
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    const ROLE_public = 1;
    const ROLE_contacts = 2;
    const ROLE_private = 3;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    
}
