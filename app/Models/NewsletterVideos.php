<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NewsletterVideos extends Model
{
    use HasFactory;

    protected $table = 'newsletter_videos';  // Optional, only if the table name is not 'newsletter_videos'

    protected $fillable = ['youtube_video_id'];
}
