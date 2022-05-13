<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prize extends Model
{
    use HasFactory;

    protected $fillable = [
        'price','name','description','visible'
    ];
    protected $with = 'users';

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_prizes');
    }


}
