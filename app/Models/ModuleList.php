<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleList extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function activity(){
        return $this->hasMany(ModuleListStudent::class);
    }

    public function completedActivities()
    {
        return $this->hasMany(ModuleListStudent::class)->where('status', 2)->whereNotNull('file');
    }
}
