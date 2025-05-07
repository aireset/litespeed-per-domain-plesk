<?php
use pm_Context;
use pm_Session;

// 1) Inicializa o contexto do módulo
pm_Context::init('toggle-litespeed');

// 2) Requer o autoloader do Composer
require_once pm_Context::getPlibDir() . '/vendor/autoload.php';

// use Plesk\Module\ToggleLitespeed\Toggle;

// 3) Recupera o domínio atual direto da sessão
$session = new pm_Session();
$domain  = $session->getCurrentDomain();

// Se não tiver domínio no contexto, erro
if (! $domain instanceof pm_Domain) {
    http_response_code(400);
    exit('Domínio não encontrado na sessão');
}

// 4) Lê apenas o action (enable|disable)
$action = $_GET['action'] ?? '';
if (! in_array($action, ['enable','disable'], true)) {
    http_response_code(400);
    exit('Parâmetro action inválido');
}

// 5) Faz o toggle
$domainName = $domain->getName();
// phpinfo();
/*highlight_string("<?php\n\$domain =\n" . var_export($domain, true) . ";\n?>");*/

$referer = $_SERVER['HTTP_REFERER'] ?? '/smb/web/overview/id/' . $domain->getId() . '/type/domain';

// echo '<pre>';
// var_dump($domain->getVhostSystemPath() );
// // var_dump(pm_Context::getBaseUrl());
// // var_dump($domain->getSetting());
// echo '</pre>';
// die();

Modules_ToggleLitespeed_Toggle::isEnabled($domain->getVhostSystemPath(), $domainName);
die;

Modules_ToggleLitespeed_Toggle::apply($domain->getVhostSystemPath(), $domainName, $action === 'enable');

// 6) Redireciona de volta para a página de onde veio (overview do domínio)
header('Location: ' . $referer);
exit;
