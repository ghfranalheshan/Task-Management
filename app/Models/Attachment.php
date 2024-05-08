<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = ['task_id', 'file_size','file_type','file_path','file_name'];
    use HasFactory;
    
    public function task()
{
    return $this->belongsTo(Task::class);
}
}
