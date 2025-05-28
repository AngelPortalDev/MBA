<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArtificialIntelligenceQuestion extends Model
{
    use HasFactory, SoftDeletes;
    public $timestamps = false;
    public $table = 'exam_artificial_intelligence_questions';
    protected $guarded  = [];
    protected $visible  = ['id', 'artificial_intelligence_id', 'question', 'marks', 'status', 'artificialIntelligenceAnswers'];

    public function artificialIntelligenceAnswers()
    {
        return $this->hasMany(ArtificialIntelligenceAnswer::class,  'question_id');
    }
}
