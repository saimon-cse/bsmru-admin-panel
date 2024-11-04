<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notices extends Model
{
    use HasFactory;

    protected $table = "notices";
    protected $primaryKey = "id";
    protected $fillable = ['not_title', 'not_des', 'not_file', 'not_date', 'rank'];

}
