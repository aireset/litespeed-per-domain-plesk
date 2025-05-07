<?php
require_once __DIR__ . '/../src/plib/vendor/autoload.php';

use Plesk\Module\ToggleLitespeed\Toggle;
use pm_Domain;

$domains    = pm_Domain::getAllDomains();
$statusList = [];

foreach ($domains as $domain) {
    $statusList[] = [
        'name'   => $domain->getName(),
        'status' => Toggle::isEnabled($domain->getName()) ? 'Ativado' : 'Desativado',
    ];
}
?>
<ul style="font-family: sans-serif; padding: 20px;">
  <?php foreach ($statusList as $item): ?>
    <li><strong><?= htmlspecialchars($item['name']) ?></strong>: <?= $item['status'] ?></li>
  <?php endforeach; ?>
</ul>
