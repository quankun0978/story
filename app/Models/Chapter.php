<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;
    public $timestamps=false;
    public function story()
{
    return $this->belongsTo(Story::class,'story_id','id');

}
protected $fillable = [
    'title',
    'content',
    'description',
    'status',
    'story_id',
    'slug'
];
}
