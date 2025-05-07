<?php
require_once '/usr/local/psa/admin/plib/api-common/cu.php';
require_once '/usr/local/psa/admin/plib/modules/toggle-litespeed/Toggle.php';

use Plesk\Module\ToggleLitespeed\Toggle;

$domain = preg_replace('/[^a-z0-9.-]/i', '', $_POST['domain']);
$enable = $_POST['action'] === 'enable';
Toggle::apply($domain, $enable);
header("Location: /modules/toggle-litespeed/?domainId=" . urlencode(pm_Context::getCurrentDomain()->getId()));
exit;