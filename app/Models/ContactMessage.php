<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactMessage extends Model
{
    use HasFactory;

    public function subject()
    {
        return $this->belongsTo(ContactMessageSubject::class, 'subject_id');
    }
}
