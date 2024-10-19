<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['title', 'description', 'file_path', 'file_type', 'file_size'];
}
