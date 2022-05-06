<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $primaryKey = 'id';
    public $timestamps  = false;
    protected $fillable = [ "senddate",
                            "fk_adviser",
                            "fk_team",];
}
