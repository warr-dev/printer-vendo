<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'mac',
        'ip',
        'credits'
    ];

    public static function getClientByIp($ip)
    {
        $isOnWindows = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';
        $mac = 'admin';
        if ($ip != '127.0.0.1') {
            $out = shell_exec('arp -a ' . $ip . '');
            // Regular expression to match the MAC address
            $pattern = $isOnWindows ? '/([0-9A-Fa-f]{2}-){5}[0-9A-Fa-f]{2}/' : '/(([a-f\d]{1,2}\:){5}[a-f\d]{1,2})/i';
            $mac = preg_match($pattern, $out, $matches) ? $macAddress = str_replace('-', ':', $matches[0]) : false;
        }
        if ($mac !== false) {
            $client = Client::firstOrCreate(
                ['mac' => $mac],
                ['ip' => $ip]
            );
            return $client;
        }
        return null;
    }
    public function getFilePath()
    {
        return $this->mac != 'admin' ? $this->str_replace(':', '', $this->mac) : '';
    }
}
