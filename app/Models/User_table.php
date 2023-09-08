<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_table extends Model
{
    use HasFactory;

    protected $table = 'user_table';
    protected $fillable = [
        'name',
        'email',
        'password'
    ];

}
