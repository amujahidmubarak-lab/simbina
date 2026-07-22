<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MentoringNote extends Model
{
    protected $fillable = ['mentoring_id', 'author_id', 'catatan', 'tanggal'];
    protected function casts(): array { return ['tanggal' => 'date']; }

    public function mentoring(): BelongsTo { return $this->belongsTo(Mentoring::class); }
    public function author(): BelongsTo { return $this->belongsTo(User::class, 'author_id'); }
}
