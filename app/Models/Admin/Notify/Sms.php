<?php

namespace App\Models\Admin\Notify;

use App\Models\Admin\Setting\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sms extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'public_sms';

    protected $fillable = ['title', 'tag_id', 'body', 'published_at'];

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
