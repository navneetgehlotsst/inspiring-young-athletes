<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AskQuestion extends Model
{
    use HasFactory;


    protected $table = 'ask_question';

    protected $fillable = [
        'full_name',
        'email',
        'coachandatheletes',
        'description'
    ];
}
