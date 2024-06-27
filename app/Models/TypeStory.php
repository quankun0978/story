<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeStory extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $primaryKey='id';
    public function type()
{
    return $this->belongsTo(Type::class,'type_id','id');

}
public function story()
{
    return $this->belongsTo(Story::class,'story_id','id');

}
    protected $fillable = [
        'type_id',
        'story_id'
    ];
}
