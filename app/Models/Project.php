<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
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
        'user_id',
        'client_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function objets()
    {
        return $this->hasMany(Objet::class, 'project_id');
    }

    public function controllers()
    {
        // hasManyThrough objets to controller
        return $this->hasManyThrough(Controller::class, Objet::class, 'project_id', 'object_id', 'id', 'id');

    }
}
