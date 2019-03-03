<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status_item extends Model
{
    protected $fillable = ['descricao'];
    protected $guarded = ['id'];
    protected $table = 'status_item';
    public $timestamps = false;

}