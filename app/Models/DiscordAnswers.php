<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscordAnswers extends Model
{
    use HasFactory;
    public $table = 'exam_discord_answers';
    protected $guarded  = [];
}
