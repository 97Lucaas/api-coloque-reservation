<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Invitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'first_name',
        'last_name',
        'email',
    ];

    protected $casts = [
        'flashed' => 'boolean',
    ];


    function full_name() {
        return "{$this->first_name} {$this->last_name}";
    }
}
