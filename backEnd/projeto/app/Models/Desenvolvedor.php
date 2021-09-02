<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desenvolvedor extends Model
{
    protected $table = 'Desenvolvedores';
    public $timestamps = false;
    protected $fillable = ['id','nome','sexo','idade','hobby','data_nascimento'];


    use HasFactory;

    protected $casts = [
        'data_nascimento' => 'date:d-m-Y',
    ];
}
