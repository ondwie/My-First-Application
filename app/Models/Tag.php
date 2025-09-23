<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

public function jobs()
{
     return $this->belongsToMany(\App\Models\Job::class, 'job_listing_tag', 'tag_id', 'job_listing_id');
    }
}