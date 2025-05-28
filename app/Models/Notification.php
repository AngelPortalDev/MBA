<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    public $table = 'notifications';

    protected $fillable = [
        'id',
        'notifiable_type',
        'notifiable_id',
        'type',
        'data',
        'read_at',
    ]; 
    
    public $timestamps = true;

    public function markAsRead()
    {
        $this->read_at = now();
        $this->save();
    }

    public function isRead()
    {
        return !is_null($this->read_at);
    }
}
