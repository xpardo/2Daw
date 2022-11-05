<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;
    protected $fillable=[
        'name'
    ];
    public function places()
    {
        return $this->belongsTo(Place::class);
        return $this->hasMany(Place::class);
    }

}
