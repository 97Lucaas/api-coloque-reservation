<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'key',
        'first_name',
        'last_name',
        'email',
        'scanned_by_user_id'
    ];

    public function scanned_by_user()
    {
        return $this->belongsTo(User::class, 'scanned_by_user_id', 'id');
    }

    public function scanned() {
        return !is_null($this->scanned_by_user_id);
    }

    public function full_name() {
        return "{$this->first_name} {$this->last_name}";
    }
}
