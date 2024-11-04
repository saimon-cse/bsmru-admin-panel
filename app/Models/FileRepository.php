<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileRepository extends Model
{
    use HasFactory;

    protected $table = "file_repositories";
    protected $primaryKey = "id";
}
