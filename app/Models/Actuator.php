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
        'name',
        'description',
        'controller_id',
        'user_id'
    ];

    public function controller()
    {
        return $this->belongsTo(Controller::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
