<?php

namespace App\Services;

use App\Models\Plan;
use App\Models\PlanPermission;

class PermissionService
{
    /**
     * Check if a plan has a specific permission.
     *
     * @param int $planId
     * @param int $permissionId
     * @return bool
     */

    public static function checkPermission(int $planId, int $permissionId): bool
    {
        return PlanPermission::where('plan_id', $planId)->where('permission_id', $permissionId)->exists();
    }

}
