<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamsView extends Model
{
    use HasFactory;
    protected $table = 'team_view';
    protected $primaryKey = 'id';
    public $timestamps  = false;
    protected $fillable = [ "StudentId",
                            "Student",
                            "TeamId",
                            "Team",
                            "TeamInv",
                            "TeamStatus",
                            "TeamDoc",
                            "AdviserId",
                            "Adviser",
                            "EventId",
                            "Event",
                            "CategorieId",
                            "Categorie",
                            "TeamVBO"];
}
