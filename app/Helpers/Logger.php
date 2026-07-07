<?php

namespace App\Helpers;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class Logger
{
    public static function log(
    string $action,
    ?string $modele = null,
    ?int $modeleId = null,
    ?string $details = null
): void
{
    try {
        ActivityLog::create([
            'user_id'    => Auth::id(),
            'action'     => $action,
            'modele'     => $modele,
            'modele_id'  => $modeleId,
            'details'    => $details,
            'ip_address' => Request::ip(),
            'user_agent' => substr(Request::userAgent() ?? '', 0, 200),
        ]);
    } catch (\Exception $e) {
        \Log::error('Logger error: ' . $e->getMessage());
    }
}
}

