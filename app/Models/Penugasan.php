<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\Auditable;

class Penugasan extends Model
{
    use Auditable;

    protected $fillable = ['kegiatan_id', 'user_id', 'assigned_by', 'judul', 'deskripsi', 'status', 'deadline'];
    protected function casts(): array { return ['deadline' => 'date']; }

    public function kegiatan(): BelongsTo { return $this->belongsTo(Kegiatan::class); }
    public function user(): BelongsTo { return $this->belongsTo(User::class); }
    public function assigner(): BelongsTo { return $this->belongsTo(User::class, 'assigned_by'); }
}
