<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requestsview extends Model
{
    use HasFactory;
    protected $table = 'requests_view';
    protected $primaryKey = 'id';
    public $timestamps  = false;
    protected $fillable = [ "requestdate",
                            "fk_student",
                            "fk_adviser",
                            "fk_team",
                            "fk_admin",
                            "fk_evaluator",
                            "name"];
}
