<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'slug'];

    public function threads()
    {
        return $this->hasMany(Thread::class);
    }

    public function activeThreads()
    {
        return $this->threads()->where('is_closed', false);
    }

    public function closedThreads()
    {
        return $this->threads()->where('is_closed', true);
    }
}
