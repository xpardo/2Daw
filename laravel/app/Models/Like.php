<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Like extends Model
{
    use HasFactory;

    protected $table = 'likeable_likes';
    public $timestamps = true;
    protected $fillable = ['likeable_id', 'likeable_type', 'user_id'];
      /**
     * @access private
     */
    public function likeable()
    {
        return $this->morphTo();
    }
}
