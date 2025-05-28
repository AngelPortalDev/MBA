<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtificialIntelligenceAnswer extends Model
{
    use HasFactory;
    public $table = 'exam_artificial_intelligence_answers';
    protected $guarded  = [];

    public function AwardCourse()
    {
        return $this->hasOne(CourseModule::class, 'id', 'award_id')->where('category_id', 1);
    }

    public function artificialIntelligenceQuestion()
    {
        return $this->hasMany(ArtificialIntelligenceQuestion::class,  'id', 'question_id')->where('is_deleted', 'No');
    }
}
