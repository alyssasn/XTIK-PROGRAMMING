<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $table = 'tbl_agenda';

    public $timestamps = false;

    protected $fillable = [
        'judul',
        'foto',
        'tanggal',
        'deskripsi',
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
}
