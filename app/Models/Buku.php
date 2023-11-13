<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'penulis',
        'id_penerbit',
        'status',
    ];

    public function penerbit()
    {
        return $this->belongsTo(User::class, 'id_penerbit', 'id_user');
    }
}
