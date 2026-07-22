<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Muhasabah extends Model
{
    protected $fillable = ['user_id', 'tanggal_awal_pekan', 'capaian', 'kendala', 'target'];
    protected function casts(): array { return ['tanggal_awal_pekan' => 'date']; }

    public function user(): BelongsTo { return $this->belongsTo(User::class); }
}
