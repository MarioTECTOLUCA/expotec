<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class califications_view extends Model
{
    use HasFactory;
    protected $table = 'califications_view';
    protected $primaryKey = 'id';
    public $timestamps  = false;
    protected $fillable = [ "fk_eva_has_items",
                            "fk_team",
                            "fk_evaluator",
                            "fk_categorie",
                            "score",
                            "date",
                            "nameTeam",
                            "categorieName", ];
}
