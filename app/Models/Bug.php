<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bug extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'user_id'
    ];

    public function columns()
    {
        return $this->morphedByMany(Column::class, 'buggable');
    }

    public function users()
    {
        return $this->morphedByMany(User::class, 'buggable');
    }
}
