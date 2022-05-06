<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advisers extends Model
{
    use HasFactory;
    protected $table = 'advisers';
    protected $primaryKey = 'id';
    public $timestamps  = false;
    protected $fillable = [ "name",
                            "email",
                            "password",
                            "status",
                            "role", ];
}
