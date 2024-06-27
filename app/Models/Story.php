<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $dates=[
        "created_at",
        "updated_at"
    ];
    public function category()
{
    return $this->belongsTo(Category::class,'category_id','id');

}
public function type()
{
    return $this->belongsTo(Type::class,'type_id','id');

}
public function chapter()
{
    return $this->hasMany(Chapter::class,'story_id','id');
}
public function typeStory()
{
    return $this->hasMany(TypeStory::class,'story_id','id');
}
protected $fillable = [
    'name',
    'slug',
    'description',
    'status',
    'image',
    'category_id',
    'author',
    'key_word',
    "type_id",
    "created_at",
    "updated_at"
];
}
