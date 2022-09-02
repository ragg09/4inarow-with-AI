<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $table = 'players';
    protected $fillable = [
        'player1',
        'player2',
        'winner',
    ];
    public $timestamps = true;
}
