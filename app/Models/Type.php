<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    // projects al plurale perche essendo una relazione uno a molti ogni type può avere molti projects
    public function projects(){
        return $this->hasMany(Project::class);
    }
}
