<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'area',
        'category',
        'detail',
        'img_url'
    ];

    //リレーション
    public function like()
    {
        return $this->hasMany(Like::class);
    }

    public function reserve()
    {
        return $this->hasMany(Reserve::class);
    }
}
