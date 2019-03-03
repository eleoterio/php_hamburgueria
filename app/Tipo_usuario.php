<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo_usuario extends Model
{
    protected $fillable = ['descricao'];
    protected $guarded = ['id'];
    protected $table = 'tipo_usuario';
    public $timestamps = false;

}