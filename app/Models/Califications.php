<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Califications extends Model
{
    use HasFactory;
    protected $table = 'califications';
    protected $primaryKey = 'id';
    public $timestamps  = false;
    protected $fillable = [ "fk_eva_has_items",
                            "fk_team",
                            "fk_evaluator",
                            "score",
                            "date",
                             ];
}
