<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

   
    const AUTHOR= 1;
    const EDITOR = 2;
    const ADMIN = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable=[
        'name'
    ];
}