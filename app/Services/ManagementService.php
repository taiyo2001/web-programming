<?php

namespace App\Services;

use App\Models\Money_management;


class ManagementService
{
    public function checkOwnManagement(int $userId, int $managementId): bool
    {
        $management = Money_management::where('id', $managementId)->first();
        if(!$management) {
            return false;
        }
        return $management->user_id === $userId;
    }
}