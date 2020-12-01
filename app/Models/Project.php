<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'deadline',
        'notes',
        'completion_percent',
        'project_budget',
        'currency',
        'status',
        'organization_id',
        'team_id',///???
    ];

    public function organization(){
        return $this->belongsTo('App\Models\Organization');
    }
    public function milestones(){
        return $this->hasMany('App\Models\Milestone');
    }
    public function team(){
        return $this->hasMany('App\Models\Team');
    }
}
