<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluations extends Model
{
    use HasFactory;
    protected $table = 'evaluations';
    protected $primaryKey = 'id';
    public $timestamps  = false;
    protected $fillable = [ "name",
                            "score",
                            "fk_categorie", ];
}
