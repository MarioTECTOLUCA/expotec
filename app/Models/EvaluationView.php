<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationView extends Model
{
    use HasFactory;
    protected $table = 'evaluation_view';
    protected $primaryKey = 'id';
    public $timestamps  = false;
    protected $fillable = [ "fk_evaluations",
                            "fk_items",
                            "EvaluationName",
                            "EvaluationScore",
                            "CategorieId",
                            "CategorieName",
                            "ItemName",
                            "ItemScore", ];
}
