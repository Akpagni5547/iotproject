<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaptorValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'values',
        'captor_id'
    ];

    public function captor()
    {
        return $this->belongsTo(Captor::class);
    }
}
