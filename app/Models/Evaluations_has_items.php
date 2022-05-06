<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluations_has_items extends Model
{
    use HasFactory;
    protected $table = 'evaluations_has_items';
    protected $primaryKey = 'id';
    public $timestamps  = false;
    protected $fillable = [ "fk_evaluations",
                            "fk_items",];
}
