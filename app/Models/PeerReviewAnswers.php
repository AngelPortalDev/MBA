<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeerReviewAnswers extends Model
{
    use HasFactory;
    public $table = 'exam_peer_review_answers';
    protected $guarded  = [];
}
