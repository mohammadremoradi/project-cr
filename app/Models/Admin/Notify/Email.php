<?php

namespace App\Models\Admin\Notify;

use App\Models\Admin\Fclient;
use App\Models\Admin\Notify\MailFile;
use App\Models\Admin\Setting\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Email extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'public_mail';

    protected $fillable = ['subject', 'body', 'tag_id', 'published_at'];


    public function files()
    {
        return $this->hasMany(MailFile::class, 'public_mail_id');
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

}
