<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slide extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'slides';
    protected $primaryKey = 'id';


    protected $fillable = ['text', 'img' , 'type' , 'rate' , 'title' , 'tag' , 'blogUrl'];


}
