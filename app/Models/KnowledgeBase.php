<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use App\Traits\Auditable;

class KnowledgeBase extends Model
{
    use Auditable;

    protected $fillable = ['judul', 'slug', 'konten', 'tipe', 'parent_id', 'created_by', 'is_published'];
    protected function casts(): array { return ['is_published' => 'boolean']; }

    protected static function booted(): void
    {
        static::creating(function ($kb) {
            if (empty($kb->slug)) { $kb->slug = Str::slug($kb->judul); }
        });
    }

    public function parent(): BelongsTo { return $this->belongsTo(KnowledgeBase::class, 'parent_id'); }
    public function children(): HasMany { return $this->hasMany(KnowledgeBase::class, 'parent_id'); }
    public function creator(): BelongsTo { return $this->belongsTo(User::class, 'created_by'); }
}
