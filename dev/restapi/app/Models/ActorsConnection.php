<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActorsConnection extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_movie',
        'id_actors'
    ];
    public $timestamps = false;
    public $table = "actorsconnection";
}
