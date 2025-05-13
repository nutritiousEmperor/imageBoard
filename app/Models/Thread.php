<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory;

    protected $fillable = ['board_id', 'title', 'body', 'is_closed'];

    public function board()
    {
        return $this->belongsTo(Board::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }
}
