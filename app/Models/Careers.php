<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Careers extends Model
{
    use HasFactory;
    protected $table = 'careers';
    protected $primaryKey = 'id';
    public $timestamps  = false;
    protected $fillable = [ "name", ];
}
