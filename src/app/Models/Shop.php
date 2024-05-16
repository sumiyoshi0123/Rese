<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'area_id',
        'category_id',
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

    public function Area()
    {
        return $this->belongsTo(Area::class);
    }

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }

    //ローカルスコープ
    public function scopeAreaSearch($query,$area_id)
    {
        if (!empty($asea_id)) {
            $query->where('area_id', $area_id);
        }
    }

    public function scopeCategorySearch($query, $category_id)
    {
        if (!empty($category_id)) {
            $query->where('category_id', $category_id);
        }
    }

    public function scopeKeywordSearch($query, $keyword)
    {
        if (!empty($keyword)) {
            $query->where('content', 'like', '%' . $keyword . '%');
        }
    }
}
