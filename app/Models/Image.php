<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    // Menentukan kolom yang dapat diisi secara massal
    protected $fillable = [
        'user_id',
        'image_path',
    ];

    // Jika Anda ingin menambahkan relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}