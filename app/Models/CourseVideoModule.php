<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\{Auth};
use App\Models\{SectionModel, SectionManagement};

class CourseVideoModule extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'course_modules_videos';
    protected $guarded  = [];
    protected $visible = ['video_title', 'section_id', 'bn_video_url_id', 'video_duration', 'video_file_name', 'id', 'SectionVideo', 'is_deleted'];

    public function Section()
    {
        return $this->belongsTo(SectionModel::class,  'section_id')->where('is_deleted','No');
    }

    public function SectionVideo()
    {
        return $this->hasMany(SectionModel::class, 'id', 'section_id')->where('is_deleted','No');
    }
    public function getVideos($where = [], $select = [])
    {
        if (Auth::check()) {
            $query = $this->with('SectionVideo');
            $videosData = [];
            if (isset($where) && count($where) > 0 && is_array($where)) {
                $videosData = $query->where($where)->OrderByDesc('created_at')->get()->toArray();
            } else {
                $videosData = $query->get()->toArray();
            }
            return $videosData;
        }
        return redirect('/login');
    }
}