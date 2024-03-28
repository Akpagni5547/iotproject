<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objet extends Model
{
    protected $table = 'objects';
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'code',
        'elements',
        'description',
        'position',
        'user_id',
        'project_id',
    ];



    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function captors()
    {
        return $this->hasMany(Captor::class);
    }

    public function actuators()
    {
        return $this->hasMany(Actuator::class);
    }

}
