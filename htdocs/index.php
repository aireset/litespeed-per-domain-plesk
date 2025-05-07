<?php
use Plesk\Module\ToggleLitespeed\Toggle;

pm_Context::init('toggle-litespeed');
$domain = pm_Context::getCurrentDomain();
?>
<html>
<head>
  <style>
    body { font-family: sans-serif; padding: 20px; }
    button { padding: 10px 15px; margin: 10px; font-weight: bold; }
  </style>
</head>
<body>
<?php if ($domain): ?>
  <?php $status = Toggle::isEnabled($domain->getName()); ?>
  <h2>Alternar LiteSpeed para: <b><?= $domain->getName() ?></b></h2>
  <form method="post" action="/toggle-litespeed/toggle.php">
    <input type="hidden" name="domain" value="<?= htmlspecialchars($domain->getName()) ?>">
    <button name="action" value="enable">Ativar LiteSpeed</button>
    <button name="action" value="disable">Desativar LiteSpeed</button>
  </form>
  <p>Status atual: <b><?= $status ? 'Ativado' : 'Desativado' ?></b></p>
<?php else: ?>
  <h2>Selecione um domínio para alternar o LiteSpeed.</h2>
<?php endif; ?>
</body>
</html>