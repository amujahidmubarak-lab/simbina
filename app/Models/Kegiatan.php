<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\Auditable;

class Kegiatan extends Model
{
    use Auditable;

    protected $fillable = [
        'judul',
        'deskripsi',
        'tanggal_waktu',
        'tempat',
        'tipe',
        'status',
        'kontrakan_id',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_waktu' => 'datetime',
        ];
    }

    public function kontrakan(): BelongsTo
    {
        return $this->belongsTo(Kontrakan::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
