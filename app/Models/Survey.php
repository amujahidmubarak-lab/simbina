<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\Auditable;

class Survey extends Model
{
    use Auditable;

    protected $fillable = ['kegiatan_id', 'judul', 'deskripsi', 'aktif', 'created_by'];
    protected function casts(): array { return ['aktif' => 'boolean']; }

    public function kegiatan(): BelongsTo { return $this->belongsTo(Kegiatan::class); }
    public function creator(): BelongsTo { return $this->belongsTo(User::class, 'created_by'); }
    public function responses(): HasMany { return $this->hasMany(SurveyResponse::class); }
}
