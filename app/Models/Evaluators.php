<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluators extends Model
{
    use HasFactory;
    protected $table = 'evaluators';
    protected $primaryKey = 'id';
    public $timestamps  = false;
    protected $fillable = [ "name",
                            "email",
                            "password",
                            "role",
                            "fk_categorie",
                            "fk_event", ];
}
