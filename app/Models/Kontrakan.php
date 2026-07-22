<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\Auditable;

class Kontrakan extends Model
{
    use Auditable;

    protected $fillable = [
        'nama_kontrakan',
        'alamat',
        'deskripsi',
        'kapasitas',
        'penanggung_jawab',
        'status',
    ];

    public function penanggungJawab(): BelongsTo
    {
        return $this->belongsTo(User::class, 'penanggung_jawab');
    }

    public function members(): HasMany
    {
        return $this->hasMany(KontrakanMember::class);
    }
}
