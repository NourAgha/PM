<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'deadline',
        'description',
        'user_id',
        'milestone_id', 

    ];

    public function milestone(){
        return $this->hasMany('App\Models\Milestone');
    }
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
