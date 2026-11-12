<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'tbl_berita';

    public $timestamps = false;

    protected $fillable = [
        'judul',
        'isi',
        'foto',
        'tanggal',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function getGambarAttribute(): ?string
    {
        return $this->attributes['foto'] ?? null;
    }

    public function setGambarAttribute(?string $value): void
    {
        $this->attributes['foto'] = $value;
    }

    public function getDeskripsiAttribute(): ?string
    {
        return $this->attributes['isi'] ?? null;
    }

    public function setDeskripsiAttribute(?string $value): void
    {
        $this->attributes['isi'] = $value;
    }
}
