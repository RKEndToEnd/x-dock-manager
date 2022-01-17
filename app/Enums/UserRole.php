<?php

namespace App\Enums;

class UserRole
{
    const SUPERADMIN = 'superadmin';
    const ADMIN = 'admin';
    const MODERATOR = 'moderator';
    const USER = 'user';
    const OBSERVER = 'observer';
    const TYPES = [
        self::SUPERADMIN,
        self::ADMIN,
        self::MODERATOR,
        self::USER,
        self::OBSERVER
    ];
}
