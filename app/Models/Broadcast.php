<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\Auditable;

class Broadcast extends Model
{
    use Auditable;

    protected $fillable = ['sender_id', 'judul', 'konten', 'target_type', 'target_id', 'is_penting'];
    protected function casts(): array { return ['is_penting' => 'boolean']; }

    public function sender(): BelongsTo { return $this->belongsTo(User::class, 'sender_id'); }
}
