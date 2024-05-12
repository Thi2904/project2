<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class major extends Model
{
    use HasFactory;
    protected $table = 'major';
    protected $fillable = ['majorName'];

    public function classes()
    {
        return $this->hasMany(Classes::class, 'majorID');
    }
}
