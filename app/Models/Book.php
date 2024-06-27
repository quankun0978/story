<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $dates=[
        "created_at",
        "updated_at"
    ];
    protected $fillable = [
        'name',
        'slug',
        'description',
        'status',
        'image',
        'content',
        'author',
        'key_word',
        'link_pdf',
        "created_at",
        "updated_at"
    ];
}
