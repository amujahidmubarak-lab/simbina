<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\Auditable;

class Attendance extends Model
{
    use Auditable;

    protected $fillable = ['kegiatan_id', 'user_id', 'status', 'keterangan'];

    public function kegiatan(): BelongsTo { return $this->belongsTo(Kegiatan::class); }
    public function user(): BelongsTo { return $this->belongsTo(User::class); }
}
