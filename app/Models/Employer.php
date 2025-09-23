<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
public function jobs()
{
return $this->hasMany(\App\Models\Job::class);
}

use HasFactory;
}
