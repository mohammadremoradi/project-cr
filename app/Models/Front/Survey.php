<?php

namespace App\Models\Front;

use App\Models\Admin\Fclient;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id', 'user_id',
        'comment', 'value'
    ];
    public function client()
    {
        return $this->belongsTo(Fclient::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class );
    }

}
