<?php
require_once __DIR__ . '/../vendor/autoload.php';
use Plesk\Module\ToggleLitespeed\Toggle;
use pm_Context;

// Sanitiza e obtém parâmetros
$domain   = preg_replace('/[^a-z0-9.\\-]/i', '', $_GET['domain']   ?? '');
$action   = $_GET['action']   ?? '';
$domainId = (int) ($_GET['domainId'] ?? 0);

// Validação
if (!in_array($action, ['enable','disable'], true) || !$domainId) {
    http_response_code(400);
    exit('Parâmetros inválidos');
}

// Aplica toggle
Toggle::apply($domain, $action === 'enable');

// Redireciona de volta para a lista de botões do domínio
header(
    'Location: '
    . pm_Context::getBaseUrl()
    . 'index.php?domainId='
    . $domainId
);
exit;
