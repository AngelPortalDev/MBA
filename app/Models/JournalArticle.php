<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\{Auth};

class JournalArticle extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'course_content_docs';
    protected $guarded  = [];


    public function Section()
    {
        return $this->belongsTo(SectionModel::class, 'section_id', 'id')->where('is_deleted', 'No');
    }
    public function getArticleDetails($where = [], $select = [])
    {
        if (Auth::check()) {
            $query = $this->with('Section')->orderByDesc('id');
            $data = [];
            if (isset($where) && count($where) > 0 && is_array($where)) {
                $data = $query->where($where)->get()->toArray();
            } else {
                $data = $query->get()->toArray();
            }
            return $data;
        }
        return redirect('/login');
    }
}