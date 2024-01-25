<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;


    protected $table = 'question';

    protected $fillable = [
        'question_id',
        'question_type',
        'question',
        'question_status',
    ];
}
