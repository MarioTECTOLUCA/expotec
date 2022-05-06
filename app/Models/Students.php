<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;
    protected $table = 'students';
    protected $primaryKey = 'id';
    public $timestamps  = false;
    protected $fillable = [ "name",
                            "noctrl",
                            "fk_gender",
                            "semester",
                            "birthday",
                            "email",
                            "password",
                            "status",
                            "fk_career",];
}
