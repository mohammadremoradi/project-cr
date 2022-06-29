<?php

namespace App\Models\admin\setting;

use App\Models\Admin\Fclient;
use App\Models\Admin\Notify\Email;
use App\Models\Admin\Notify\Sms;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory , SoftDeletes;


    protected $fillable = ['name'];

    public function clients(){

        return $this->hasMany(Fclient::class);
    }

    public function emails(){

        return $this->hasMany(Email::class);
    }
    public function smses(){

        return $this->hasMany(Sms::class);
    }


}
