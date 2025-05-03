<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function subject(){
        return $this->belongsTo(Subject::class);
    }

    public function year(){
        return $this->belongsTo(Year::class);
    }

    public function section(){
        return $this->belongsTo(section::class);
    }

    public function teacher(){
        return $this->belongsTo(teacher::class);
    }

    public function list(){
        return $this->hasMany(ScheduleStudent::class);
    }


    public function modules(){
        return $this->hasMany(Module::class);
    }

}
