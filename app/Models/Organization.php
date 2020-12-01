<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'domain_name',
        'description',
    ];

    public function users(){
        return $this->hasMany('App\Models\User');
    }
    public function teams(){
        return $this->hasMany('App\Models\Team');
        // return $this->hasMany(Team::class,'organization_id'); 
    }
    public function projects(){
        return $this->hasMany('App\Models\Project');
    }

   
}
