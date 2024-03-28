<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actuator extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'values',
        'object_id',
    ];

    protected $casts = [
        'values' => 'json',
    ];

    public function object()
    {
        return $this->belongsTo(Objet::class, 'object_id');
    }

}
