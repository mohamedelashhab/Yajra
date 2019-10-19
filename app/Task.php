<?php

namespace App;

use App\Http\Controllers\Traits\FileUpload;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;
    

    protected $guarded = [];
}
