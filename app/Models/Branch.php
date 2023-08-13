<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $fillable = [
        'branch_name',
        'user_id',
        'branch_code',
    ];

    public function parent()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
