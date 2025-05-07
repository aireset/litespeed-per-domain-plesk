<?php
namespace Plesk\Module\ToggleLitespeed;

class Toggle
{
    public static function isEnabled(string $domain): bool
    {
        $path = "/var/www/vhosts/{$domain}/conf/vhost.conf";
        if (!file_exists($path)) {
            return false;
        }
        return strpos(file_get_contents($path), 'ProxyPass') !== false;
    }

    public static function apply(string $domain, bool $enable): void
    {
        $path = "/var/www/vhosts/{$domain}/conf/vhost.conf";
        if (file_exists($path)) {
            copy($path, "{$path}.bak");
        }
        if ($enable) {
            $content = <<<CONF
<IfModule mod_proxy.c>
  ProxyPass / http://127.0.0.1:1080/
  ProxyPassReverse / http://127.0.0.1:1080/
</IfModule>

CONF;
            file_put_contents($path, $content, LOCK_EX);
        } else {
            @unlink($path);
        }
        exec(
            "/usr/local/psa/admin/sbin/httpdmng --reconfigure-domain "
            . escapeshellarg($domain),
            $output,
            $code
        );
        if ($code !== 0) {
            throw new \RuntimeException("httpdmng falhou: " . implode("\n", $output));
        }
    }
}
