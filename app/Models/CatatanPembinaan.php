<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\Auditable;

class CatatanPembinaan extends Model
{
    use Auditable;

    protected $fillable = ['user_id', 'author_id', 'tipe', 'konten'];

    public function user(): BelongsTo { return $this->belongsTo(User::class); }
    public function author(): BelongsTo { return $this->belongsTo(User::class, 'author_id'); }
}
