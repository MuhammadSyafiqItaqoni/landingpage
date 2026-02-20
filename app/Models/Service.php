<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'service'; // Penting: sesuai poin 2 di foto

    protected $fillable = ['title', 'description', 'image'];
}
