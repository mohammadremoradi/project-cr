<?php

namespace App\Models\Front\Consumer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConsumerFile extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'type', 'file_path', 'activation', 'file_name', 'activation',
        'consumer_id'
    ];
    public function consumer()
    {
        return $this->belongsTo(Consumer::class);
    }
}
