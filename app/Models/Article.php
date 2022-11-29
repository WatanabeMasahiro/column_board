<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    // protected $fillable = ['', '',];

    protected $guarded = [
        'id',
    ];

    // public static $rules = ['' => ''];

    // public function comments()
    // {
    //     return $this->hasmany('App\Models\Comment')
    // }


    public function comment_s()
    {
        return $this->hasMany('App\Models\Comment');
    }

}
