<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificateIssue extends Model
{
    use HasFactory;
    public $table = 'certitficate_issue';
    protected $guarded  = [];
    public $timestamps = false;

}
