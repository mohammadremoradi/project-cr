<?php

namespace App\Models\Front\Consumer;

use App\Models\Admin\Fclient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Consumer extends Model
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;


    protected $fillable = [
        'passport', 'status_id', 'activation',
        'client_id', 'user_id'
    ];

    public function client(){
        return $this->belongsTo(Fclient::class);
    }

    public function files(){
        return $this->hasMany(ConsumerFile::class , 'consumer_id');
    }


}
