<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class curriculums extends Model
{
    use HasFactory;
    protected $table = 'curriculum';
    protected $fillable = ['curriculumName', 'majorID','note'];

    public function classes()
    {
        return $this->hasMany(Classes::class, 'curriculumID');
    }

    public function major()
    {
        return $this->belongsTo(Major::class, 'majorID');
    }

}
