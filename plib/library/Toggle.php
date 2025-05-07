<?php
/**
 * Lógica de toggle do LiteSpeed
 */
class Modules_ToggleLitespeed_Toggle
{
    public static function isEnabled($vhost, $domain)
    {
        // $path = "/var/www/vhosts/{$domain}/conf/vhost.conf";
        $path = "{$vhost}/conf/vhost.conf";

        echo $path;
        echo file_exists($path);
        echo file_get_contents($path);

        // return file_exists($path)
            // && strpos(file_get_contents($path), 'ProxyPass') !== false;
    }

    public static function apply($vhost, $domain, $enable)
    {
        // $path = "/var/www/vhosts/{$domain}/conf/vhost.conf";
        $path = "{$vhost}/conf/vhost.conf";

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

        // reconfigura via CLI do Plesk
        try {
            \pm_ApiCli::callSbin('httpdmng', ['--reconfigure-domain', $domain], \pm_ApiCli::RESULT_FULL);
        } catch (\pm_Exception $e) {
            throw new \RuntimeException("httpdmng falhou: " . $e->getMessage());
        }
    }
}
