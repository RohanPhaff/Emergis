<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'employees',
    ];

    protected $casts = [
        'employees' => 'array',
    ];

    public function path()
    {
        return route('departments.show', $this);
    }
}
