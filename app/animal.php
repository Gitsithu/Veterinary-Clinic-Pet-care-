<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class animal extends Model
{
    //
    use SoftDeletes;
    protected $dates = ['deleted_at']; 
  
    protected $table = 'animal';
    protected $fillable = ['id','name','status'];
}
