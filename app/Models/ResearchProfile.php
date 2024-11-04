<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchProfile extends Model
{
    use HasFactory;
    protected $table = "research_profiles";
    protected $primaryKey = "id";
}
