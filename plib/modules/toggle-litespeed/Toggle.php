<?php
namespace Plesk\Module\ToggleLitespeed;

class Toggle
{
    public static function isEnabled($domain)
    {
        $path = "/var/www/vhosts/$domain/conf/vhost.conf";
        if (!file_exists($path)) return false;
        return strpos(file_get_contents($path), 'ProxyPass') !== false;
    }

    public static function apply($domain, $enable)
    {
        $path = "/var/www/vhosts/$domain/conf/vhost.conf";
        if ($enable) {
            file_put_contents($path, "<IfModule mod_proxy.c>\n  ProxyPass / http://127.0.0.1:1080/\n  ProxyPassReverse / http://127.0.0.1:1080/\n</IfModule>\n");
        } else {
            @unlink($path);
        }
        exec("/usr/local/psa/admin/sbin/httpdmng --reconfigure-domain " . escapeshellarg($domain));
    }
}