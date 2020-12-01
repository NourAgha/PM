<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'project_id',

    ];

    public function project(){
        return $this->belongsTo('App\Models\Project');
    }
    public function tasks(){
        return $this->belongsTo('App\Models\Task');
    }
}
