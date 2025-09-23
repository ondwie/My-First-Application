<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Job extends Model
{
use HasFactory;
// By convention, Laravel assumes a 'jobs' table.
// We need to tell it to use our 'job_listings' table instead.
protected $table = 'job_listings';
}
