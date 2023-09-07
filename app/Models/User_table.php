<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_table extends Model
{
    use HasFactory;

    protected $table = 'user-tables';
    protected $fillable = [
        'name',
        'email',
        'password'
    ];

}
