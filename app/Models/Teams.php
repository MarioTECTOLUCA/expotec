<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{
    use HasFactory;
    protected $table = 'teams';
    protected $primaryKey = 'id';
    public $timestamps  = false;
    protected $fillable = [ "name",
                            "status",
                            "urldoc",
                            "fk_adviser",
                            "fk_categorie",
                            "fk_event",
                            "active_invitations", ];
}
