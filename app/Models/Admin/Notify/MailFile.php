<?php

namespace App\Models\admin\notify;

use App\Models\Admin\Notify\Email;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MailFile extends Model
{
    use HasFactory ,SoftDeletes;
    protected $table = 'public_mail_files';
    protected $fillable = ['public_mail_id' , 'file_path' , 'file_size' , 'file_type' , 'file_name' , 'saveAs'];


    public function email(){
        return $this->BelongsTo(Email::class , 'public_mail_id');
    }


}
