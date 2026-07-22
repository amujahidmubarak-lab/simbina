<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\Auditable;

class KasKontrakan extends Model
{
    use Auditable;

    protected $fillable = ['kontrakan_id', 'user_id', 'tipe', 'jumlah', 'keterangan', 'tanggal'];
    protected function casts(): array { return ['tanggal' => 'date']; }

    public function kontrakan(): BelongsTo { return $this->belongsTo(Kontrakan::class); }
    public function user(): BelongsTo { return $this->belongsTo(User::class); }
}
