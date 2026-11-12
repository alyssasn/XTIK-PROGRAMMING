<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organigram extends Model
{
    use HasFactory;

    protected $table = 'tbl_organigram';

    public $timestamps = false;

    protected $fillable = [
        'nama',
        'jabatan',
        'foto',
    ];

    public function getGambarAttribute(): ?string
    {
        return $this->attributes['foto'] ?? null;
    }

    public function setGambarAttribute(?string $value): void
    {
        $this->attributes['foto'] = $value;
    }

    public function getNamaLengkapAttribute(): ?string
    {
        return $this->attributes['nama'] ?? null;
    }

    public function setNamaLengkapAttribute(?string $value): void
    {
        $this->attributes['nama'] = $value;
    }
}
