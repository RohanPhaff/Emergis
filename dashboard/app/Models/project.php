<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class project extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'man_hours',
        'budget',
        'expected_costs',
        'start_date',
        'end_date',
        'alt_projectleader',
        'initiator',
        'actor',
        'portfolio_holder',
        'reasoning',
        'uploaded_document_start',
        'uploaded_document_planning',
        'program',
        'project_status',
        'check_discussion_RvB',
        // Add all other fields here
    ];
    
    public function path()
    {
        return route('projects.show', $this);
    }
}
