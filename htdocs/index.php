<?php
use Plesk\Module\ToggleLitespeed\Toggle;

pm_Context::init('toggle-litespeed');
// Obtém ID do domínio via GET
$domainId = isset($_GET['domainId']) ? (int) $_GET['domainId'] : null;
$domain   = $domainId ? pm_Domain::getById($domainId) : null;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Toggle LiteSpeed - <?= \$domain ? htmlspecialchars(\$domain->getName()) : 'Selecione Domínio' ?></title>
  <link rel="stylesheet" href="<?= pm_Context::getBaseUrl() ?>css/style.css">
</head>
<body>
<?php if (\$domain): ?>
  <?php \$status = Toggle::isEnabled(\$domain->getName()); ?>
  <h2>Alternar LiteSpeed para: <b><?= htmlspecialchars(\$domain->getName()) ?></b></h2>
  <form method="post" action="<?= pm_Context::getBaseUrl() ?>toggle.php">
    <input type="hidden" name="domain" value="<?= htmlspecialchars(\$domain->getName()) ?>">
    <button name="action" value="enable">Ativar LiteSpeed</button>
    <button name="action" value="disable">Desativar LiteSpeed</button>
  </form>
  <p>Status atual: <b><?= \$status ? 'Ativado' : 'Desativado' ?></b></p>
<?php else: ?>
  <h2>Selecione um domínio para alternar o LiteSpeed.</h2>
<?php endif; ?>
</body>
</html>