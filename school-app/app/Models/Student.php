<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'birth_date', 'genre', 'classroom_id'];

//    protected $casts = [
//        'birth_date' => "date:d/m/Y"
//    ];

    protected $hidden = ['created_at', 'updated_at'];

//    protected $appends = ['Accepted'];
//
    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class);
    }
//
//    public function getAcceptedAttribute(): string
//    {
//        return $this->attributes['birth_date'] > '2001-01-01' ? 'aceito' : 'não aceito';
//    }
}
