<?php

namespace App\Models\admin\setting;

use App\Models\Admin\Fclient;
use App\Models\Admin\Submite;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = ['name'];

    public function FirstClients(){
        return $this->hasMany(Fclient::class);
    }

    public function submites(){
        return $this->hasMany(Submite::class);
    }
}
