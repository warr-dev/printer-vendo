<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'file_name',
        'metadata',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function getFilePath()
    {
        return $this->client->getFolder() . '/' . $this->file_name;
    }

    public function getPreviewPath()
    {
        return $this->client->getFolder() . '/preview/' . $this->file_name;
    }

    public function getThumb()
    {
        return $this->client->getFolder() . '/' . $this->file_name . '.png';
    }

    public function getMetadata()
    {
        return json_decode($this->metadata, true);
    }
}
