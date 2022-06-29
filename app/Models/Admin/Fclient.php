<?php

namespace App\Models\Admin;

use App\Models\Admin\setting\Course;
use App\Models\Admin\setting\Tag;
use App\Models\Front\Consumer\Consumer;
use App\Models\Front\Survey;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;


class Fclient extends Model
{
    use HasFactory, SoftDeletes, Sluggable;


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }


    protected $fillable = [
        'fullname', 'age',
        'degree', 'date_degree', 'language', 'job',
        'money', 'phone', 'material', 'number_children', 'age_wife', 'wife_degree',
        'wife_date_degree', 'child1', 'child2', 'child3', 'child4', 'child5', 'child6', 'about_us', 'intrest', 'hours',
        'discription', 'tag_id', 'next_call', 'status', 'intrest', 'cansultant_name', 'response', 'user_id', 'course_id', 'waiting'
    ];


    protected $table = 'first_clients';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function consumer()
    {
        return $this->hasOne(Consumer::class, 'client_id');
    }

    public function surveys()
    {
        return $this->hasMany(Survey::class);
    }
}
