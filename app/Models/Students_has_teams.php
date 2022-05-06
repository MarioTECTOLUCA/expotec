<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students_has_teams extends Model
{
    use HasFactory;
    protected $table = 'students_has_teams';
    protected $primaryKey = 'id';
    public $timestamps  = false;
    protected $fillable = [ "fk_student",
                            "fk_teams",];
}
