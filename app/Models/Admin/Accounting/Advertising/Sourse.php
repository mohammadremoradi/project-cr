<?php

namespace App\Models\Admin\Accounting\Advertising;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sourse extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'type', 'url'
    ];


    public function advertises(){
        return $this->hasMany(Advertise::class);
    }
}
