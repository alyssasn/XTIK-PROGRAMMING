<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    use HasFactory;

    protected $table = 'tbl_profil';

    public $timestamps = false;

    protected $fillable = [
        'judul',
        'isi',
        'deskripsi',
        'visi',
        'misi',
        'gambar_utama',
        'deskripsi_bawah',
    ];

    public function getDeskripsiAttribute(): ?string
    {
        return $this->attributes['deskripsi'] ?? $this->attributes['isi'] ?? null;
    }

    public function setDeskripsiAttribute(?string $value): void
    {
        $this->attributes['deskripsi'] = $value;
        if (empty($this->attributes['isi'])) {
            $this->attributes['isi'] = $value ?? '';
        }
    }
}
