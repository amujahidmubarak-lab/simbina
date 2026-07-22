<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\Auditable;

class Mentoring extends Model
{
    use Auditable;

    protected $fillable = ['mentor_id', 'mentee_id', 'start_date', 'end_date', 'status'];
    protected function casts(): array { return ['start_date' => 'date', 'end_date' => 'date']; }

    public function mentor(): BelongsTo { return $this->belongsTo(User::class, 'mentor_id'); }
    public function mentee(): BelongsTo { return $this->belongsTo(User::class, 'mentee_id'); }
    public function notes(): HasMany { return $this->hasMany(MentoringNote::class); }
}
