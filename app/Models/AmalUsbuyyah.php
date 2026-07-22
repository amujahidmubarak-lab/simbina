<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\Auditable;

class AmalUsbuyyah extends Model
{
    use Auditable;

    protected $fillable = [
        'user_id',
        'tanggal_awal_pekan',
        'puasa_sunnah',
        'baca_alkahfi',
        'olahraga',
        'bersih_kontrakan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_awal_pekan' => 'date',
            'puasa_sunnah' => 'boolean',
            'baca_alkahfi' => 'boolean',
            'olahraga' => 'boolean',
            'bersih_kontrakan' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
