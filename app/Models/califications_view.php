<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class califications_view extends Model
{
    use HasFactory;
    protected $table = 'califications_view';
    protected $primaryKey = 'id';
    public $timestamps  = false;
    protected $fillable = [ "teamId",
                            "teamName",
                            "vbo",
                            "itemId",
                            "itemName",
                            "score",
                            "categorieId",
                            "categorieName",
                            "evaluatorId",
                            "evaluatorName", ];
}
