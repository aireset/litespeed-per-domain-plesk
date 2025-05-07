<?php
// inicializa o contexto do módulo
pm_Context::init('toggle-litespeed');

// lê o domínio via GET (Plesk injeta id=DOM_ID quando context=domain)
$domainId = (int) ($_GET['id'] ?? 0);
$domain   = $domainId ? pm_Domain::getById($domainId) : null;

if (! $domain) {
    echo '<p>Selecione um domínio para alternar o LiteSpeed.</p>';
    exit;
}

// verifica status atual
$status = Modules_ToggleLitespeed_Toggle::isEnabled($domain->getName());
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
  <p>Status atual: <strong><?= $status ? 'Ativado' : 'Desativado' ?></strong></p>
</body>
</html>
