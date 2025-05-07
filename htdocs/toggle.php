<?php
require_once __DIR__ . '/../src/plib/vendor/autoload.php';

use Plesk\Module\ToggleLitespeed\Toggle;
use pm_Domain;
use pm_Context;

// Lê parâmetros que o Plesk injeta via contextParams (id=domínio + type)
$action   = $_GET['action']   ?? '';
$domainId = (int) ($_GET['id'] ?? 0);

if (!in_array($action, ['enable','disable'], true) || !$domainId) {
    http_response_code(400);
    exit('Parâmetros inválidos');
}

// Carrega o nome do domínio
$domainName = pm_Domain::getById($domainId)->getName();
// Aplica o toggle
Toggle::apply($domainName, $action === 'enable');

// Redireciona de volta à lista de módulos do Plesk
header(
    'Location: '
    . pm_Context::getBaseUrl()
    . 'index.php?domainId='
    . $domainId
);
exit;
