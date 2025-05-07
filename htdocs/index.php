<?php
require_once __DIR__ . '/../src/plib/vendor/autoload.php';

use Plesk\Module\ToggleLitespeed\Toggle;
use pm_Context;
use pm_Domain;

pm_Context::init('toggle-litespeed');

// Pega o ID do domínio na URL
$domainId = (int) ($_GET['id'] ?? 0);
$domain   = $domainId ? pm_Domain::getById($domainId) : null;

if (!$domain) {
    echo '<p>Selecione um domínio para alternar o LiteSpeed.</p>';
    exit;
}

$status = Toggle::isEnabled($domain->getName());
$action = $status ? 'disable' : 'enable';
$label  = $status ? 'Desativar LiteSpeed' : 'Ativar LiteSpeed';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Toggle LiteSpeed – <?= htmlspecialchars($domain->getName()) ?></title>
  <link rel="stylesheet" href="<?= pm_Context::getBaseUrl() ?>css/style.css">
</head>
<body>
  <h2>LiteSpeed em <strong><?= htmlspecialchars($domain->getName()) ?></strong></h2>
  <form method="get" action="<?= pm_Context::getBaseUrl() ?>toggle.php">
    <input type="hidden" name="id" value="<?= $domainId ?>">
    <input type="hidden" name="action" value="<?= $action ?>">
    <button type="submit"><?= $label ?></button>
  </form>
  <p>Status atual: <b><?= $status ? 'Ativado' : 'Desativado' ?></b></p>
</body>
</html>
