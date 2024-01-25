<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAnswere extends Model
{
    use HasFactory;


    protected $table = 'user_queston';

    protected $fillable = [
        'user_queston_id',
        'user_id',
        'question_id',
        'user_queston_type',
        'answere_vedio',
    ];
}
