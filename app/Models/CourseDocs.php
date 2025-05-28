<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseDocs extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'course_content_docs';
    protected $guarded  = [];
    protected $visible = ['docs_title', 'section_id', 'file','doc_file_name','id'];
    // public function CourseArticle()
    // {
    //     return $this->belongsTo(SectionManagement::class, 'content_id', 'id');
    // }
}