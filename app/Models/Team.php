<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'organization_id',
    ];

    
    public function organization(){
        return $this->belongsTo('App\Models\Organization');
    }
    public function projects(){
        return $this->hasMany('App\Models\Project');
    }

}
