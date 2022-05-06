<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluatorsView extends Model
{
    use HasFactory;
    protected $table = 'evaluators_view';
    protected $primaryKey = 'id';
    public $timestamps  = false;
    protected $fillable = [ "name",
                            "email",
                            "password",
                            "role",
                            "fk_categorie",
                            "categorie",
                            "event" ];
}
