<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admins extends Model
{
    use HasFactory;
    protected $table = 'admins';
    protected $primaryKey = 'id';
    public $timestamps  = false;
    protected $fillable = [ "name",
                            "email",
                            "password",
                            "role",
                            "fk_event", ];
}
