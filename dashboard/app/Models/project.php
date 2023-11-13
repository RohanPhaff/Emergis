<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
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
        'community_link',
        'project_status',
        'progress',
        'check_discussion_RvB',
    ];

    public function path()
    {
        return route('projects.show', $this);
    }
}
