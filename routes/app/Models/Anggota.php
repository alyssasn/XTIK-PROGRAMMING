<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'tbl_anggota';

    public $timestamps = false;

    protected $fillable = [
        'nama',
        'kelas',
        'jurusan',
        'jenis kelamin',
        'jenis_kelamin',
    ];

    public function getJenisKelaminAttribute(): ?string
    {
        return $this->attributes['jenis kelamin'] ?? $this->attributes['jenis_kelamin'] ?? null;
    }

    public function setJenisKelaminAttribute(?string $value): void
    {
        $this->attributes['jenis kelamin'] = $value;
    }
}
