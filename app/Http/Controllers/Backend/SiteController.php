<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;

class SiteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        $countUser = User::query()->count();

        $directory = '.';
        $bytesFreeSpace = disk_free_space($directory);
        $bytesTotalSpace = disk_total_space($directory);

        $opcacheStatus = '!! Выключен';
        if (function_exists('opcache_get_status')) {
            $opcacheStatus = 'Включен';
        }
        $memInfo = $this->getSystemMemInfo();

        return view('backend/index', [
            'countUser' => $countUser,
            'diskFreeSpace' => $this->spaceFormat($bytesFreeSpace),
            'diskTotalSpace' => $this->spaceFormat($bytesTotalSpace),
            'opcacheStatus' => $opcacheStatus,
            'loadAverage' => sys_getloadavg(),
            'time' => date('d.m.y h:i:s'),
            'memTotal' => $memInfo['MemTotal'] ?? 0,
            'memAvailable' => $memInfo['MemAvailable'] ?? 0,
        ]);
    }

    private function spaceFormat(float $bytes): string
    {
        $siPrefix = ['B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB'];
        $base = 1024;
        $class = min((int)log($bytes, $base), count($siPrefix) - 1);

        return sprintf('%1.2f', $bytes / ($base ** $class)) . ' ' . $siPrefix[$class];
    }

    private function getSystemMemInfo(): array
    {
        $data = explode("\n", file_get_contents('/proc/meminfo'));
        $memInfo = [];
        foreach ($data as $line) {
            if ($line) {
                [$key, $val] = explode(':', $line);
                $memInfo[$key] = trim($val);
            }
        }

        return $memInfo;
    }

}
