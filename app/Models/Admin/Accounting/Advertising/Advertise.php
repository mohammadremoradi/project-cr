<?php

namespace App\Models\Admin\Accounting\Advertising;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advertise extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'price', 'receipt', 'sourse_id', 'published_at' , 'statistics' , 'user_id'
    ];

    protected $dates = ['published_at'];


    public function sourse()
    {
        return $this->belongsTo(Sourse::class);
    }
}
