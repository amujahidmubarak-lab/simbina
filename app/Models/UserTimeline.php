<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserTimeline extends Model
{
    protected $fillable = ['user_id', 'tipe', 'judul', 'deskripsi', 'tanggal'];
    protected function casts(): array { return ['tanggal' => 'date']; }

    public function user(): BelongsTo { return $this->belongsTo(User::class); }
}
