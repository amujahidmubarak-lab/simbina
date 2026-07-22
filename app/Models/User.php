<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\Auditable;

#[Fillable(['name', 'email', 'password', 'status', 'alumni_date', 'last_login_at'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles, Auditable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'alumni_date' => 'date',
            'last_login_at' => 'datetime',
        ];
    }

    public function kontrakanMembers(): HasMany { return $this->hasMany(KontrakanMember::class); }
    public function amalYaumiyyahs(): HasMany { return $this->hasMany(AmalYaumiyyah::class); }
    public function amalUsbuyyahs(): HasMany { return $this->hasMany(AmalUsbuyyah::class); }
    public function attendances(): HasMany { return $this->hasMany(Attendance::class); }
    public function catatanPembinaans(): HasMany { return $this->hasMany(CatatanPembinaan::class); }
    public function mentoringAsMentor(): HasMany { return $this->hasMany(Mentoring::class, 'mentor_id'); }
    public function mentoringAsMentee(): HasMany { return $this->hasMany(Mentoring::class, 'mentee_id'); }
    public function muhasabahs(): HasMany { return $this->hasMany(Muhasabah::class); }
    public function timelines(): HasMany { return $this->hasMany(UserTimeline::class); }
    public function penugasans(): HasMany { return $this->hasMany(Penugasan::class); }
    public function surveyResponses(): HasMany { return $this->hasMany(SurveyResponse::class); }
    public function auditLogs(): HasMany { return $this->hasMany(AuditLog::class); }

    // Helper: get the kontrakan where this user is currently a member
    public function currentKontrakan()
    {
        $membership = $this->kontrakanMembers()->where('status', 'active')->latest()->first();
        return $membership ? $membership->kontrakan : null;
    }

    public function isAlumni(): bool
    {
        return $this->status === 'alumni';
    }
}
