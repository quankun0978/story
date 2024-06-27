<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $primaryKey='id';
    public $tabele='categories';
    protected $fillable = [
        'name',
        'description',
        'status',
        'slug'
    ];
}
