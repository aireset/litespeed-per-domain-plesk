<?php
require_once '/usr/local/psa/admin/plib/api-common/cu.php';
require_once '/usr/local/psa/admin/plib/modules/toggle-litespeed/Toggle.php';

use Plesk\Module\ToggleLitespeed\Toggle;

$domains = pm_Domain::getAllDomains();
$statusList = [];
foreach ($domains as $domain) {
    $name = $domain->getName();
    $statusList[] = [
        'name' => $name,
        'status' => Toggle::isEnabled($name) ? 'Ativado' : 'Desativado'
    ];
}
?>
<ul style="font-family: sans-serif; padding: 20px;">
  <?php foreach ($statusList as $item): ?>
    <li><strong><?= $item['name'] ?></strong>: <?= $item['status'] ?></li>
  <?php endforeach; ?>
</ul>