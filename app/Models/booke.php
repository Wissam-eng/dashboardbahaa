<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class booke extends Model
{
    use HasFactory, SoftDeletes;


    protected $table = 'bookes';
    protected $primaryKey = 'id';


    protected $fillable = ['first_name', 'second_name' , 'mobile' , 'address' , 'visit_date' , 'note'];
}
