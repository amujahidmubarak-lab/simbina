<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\Auditable;

class AmalYaumiyyah extends Model
{
    use Auditable;

    protected $fillable = [
        'user_id',
        'tanggal',
        'tilawah_halaman',
        'shalat_berjamaah',
        'qiyamul_lail',
        'puasa_sunnah',
        'infaq',
        'catatan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'qiyamul_lail' => 'boolean',
            'puasa_sunnah' => 'boolean',
            'infaq' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
