<?php

namespace App\Traits;

use App\Services\AuditService;

trait Auditable
{
    public static function bootAuditable()
    {
        static::created(function ($model) {
            AuditService::log('create', $model, null, $model->getAttributes());
        });

        static::updated(function ($model) {
            // Only log changes
            $changes = $model->getChanges();
            if (!empty($changes)) {
                $old = array_intersect_key($model->getOriginal(), $changes);
                AuditService::log('update', $model, $old, $changes);
            }
        });

        static::deleted(function ($model) {
            AuditService::log('delete', $model, $model->getOriginal(), null);
        });
    }
}
