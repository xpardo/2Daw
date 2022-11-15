<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission as SpatiePermission;


class Permission extends SpatiePermission
{
    use HasFactory;

    //files
    const FILES        = 'files.*';
    const FILES_LIST   = 'files.list';
    const FILES_CREATE = 'files.create';
    const FILES_READ   = 'files.read';
    const FILES_UPDATE = 'files.update';
    const FILES_DELETE = 'files.delete';

    //posts
    const POSTS        = 'posts.*';
    const POSTS_LIST   = 'posts.list';
    const POSTS_CREATE = 'posts.create';
    const POSTS_READ   = 'posts.read';
    const POSTS_UPDATE = 'posts.update';
    const POSTS_DELETE = 'posts.delete';

    //places
    const PLACES       = 'places.*';
    const PLACES_LIST   = 'places.list';
    const PLACES_CREATE = 'places.create';
    const PLACES_READ   = 'places.read';
    const PLACES_UPDATE = 'places.update';
    const PLACES_DELETE = 'places.delete';

}
