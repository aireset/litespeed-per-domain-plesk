<?php
pm_Context::init('toggle-litespeed');

$domains    = pm_Domain::getAllDomains();
$statusList = [];

foreach ($domains as $domain) {
    $statusList[] = [
        'name'   => $domain->getName(),
        'status' => Modules_ToggleLitespeed_Toggle::isEnabled($domain->getName())
                    ? 'Ativado' : 'Desativado',
    ];
}
?>
<ul style="font-family: sans-serif; padding: 20px;">
<?php foreach ($statusList as $item): ?>
  <li><strong><?= htmlspecialchars($item['name']) ?></strong>: <?= $item['status'] ?></li>
<?php endforeach; ?>
</ul>
