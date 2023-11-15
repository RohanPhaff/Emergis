<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class program extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'portfolio_holder',
    ];

    public function path()
    {
        return route('programs.show', $this);
    }
}
