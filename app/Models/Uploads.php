<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uploads extends Model
{
    use HasFactory;
    
    protected $fillable=[
        'client_id',
        'file_name',
        'metadata',
    ];

    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function getThumbnail() {
        return $this->client->getFolder().'/'.$this->file_name;
    }
}
