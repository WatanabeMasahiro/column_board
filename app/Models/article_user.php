<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article_user extends Model
{
    use HasFactory;

    // protected $fillable = ['', '',];

    protected $guarded = [
        'id',
    ];

    public function article_s()
    {
        return $this->belongsTo('App\Models\Article');
    }

}
