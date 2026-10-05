<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuditLog extends Model
{
    use HasFactory;

    /**
     * Audit log table.
     */
    protected $table = 'auditlogs';

    /**
     * Fields that can be mass assigned.
     */
    protected $fillable = [
        'user_id',
        'action',
        'module',
        'description',
        'ip_address',
        'user_agent',
        'old_values',
        'new_values',
    ];

    /**
     * Cast database values to PHP types.
     */
    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Audit log belongs to a user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Create an audit log record.
     *
     * @param string $action
     * @param string $module
     * @param string $description
     * @param array|null $oldValues
     * @param array|null $newValues
     * @param int|null $userId
     * @return self|null
     */
    public static function record(
        string $action,
        string $module,
        string $description,
        ?array $oldValues = null,
        ?array $newValues = null,
        ?int $userId = null
    ): ?self {
        try {
            $request = request();

            return self::create([
                'user_id' => $userId ?? Auth::id(),
                'action' => $action,
                'module' => $module,
                'description' => $description,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'old_values' => $oldValues,
                'new_values' => $newValues,
            ]);
        } catch (\Throwable $e) {
            Log::error('Failed to create audit log', [
                'action' => $action,
                'module' => $module,
                'description' => $description,
                'user_id' => $userId ?? Auth::id(),
                'error' => $e->getMessage(),
            ]);

            return null;
        }
    }

    /**
     * Record an update action.
     */
    public static function recordUpdate(
        string $module,
        string $description,
        ?array $oldValues = null,
        ?array $newValues = null,
        ?int $userId = null
    ): ?self {
        return self::record(
            'update',
            $module,
            $description,
            $oldValues,
            $newValues,
            $userId
        );
    }

    /**
     * Record a delete action.
     */
    public static function recordDelete(
        string $module,
        string $description,
        ?array $oldValues = null,
        ?int $userId = null
    ): ?self {
        return self::record(
            'delete',
            $module,
            $description,
            $oldValues,
            null,
            $userId
        );
    }

    /**
     * Record a create action.
     */
    public static function recordCreate(
        string $module,
        string $description,
        ?array $newValues = null,
        ?int $userId = null
    ): ?self {
        return self::record(
            'create',
            $module,
            $description,
            null,
            $newValues,
            $userId
        );
    }

    /**
     * Record a view action.
     */
    public static function recordView(
        string $module,
        string $description,
        ?int $userId = null
    ): ?self {
        return self::record(
            'view',
            $module,
            $description,
            null,
            null,
            $userId
        );
    }
}