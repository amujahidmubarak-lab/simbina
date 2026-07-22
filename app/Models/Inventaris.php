<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\Auditable;

class Inventaris extends Model
{
    use Auditable;

    protected $fillable = ['kontrakan_id', 'nama', 'jumlah', 'kondisi', 'lokasi', 'keterangan'];

    public function kontrakan(): BelongsTo { return $this->belongsTo(Kontrakan::class); }
}
