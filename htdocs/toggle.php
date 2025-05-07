<?php
require_once __DIR__ . '/../plib/vendor/autoload.php';

use Plesk\Module\ToggleLitespeed\Toggle;
use pm_Domain;
use pm_Context;

$action   = $_GET['action'] ?? '';
$domainId = (int) ($_GET['id'] ?? 0);

if (!in_array($action, ['enable','disable'], true) || !$domainId) {
    http_response_code(400);
    exit('Parâmetros inválidos');
}

$domainName = pm_Domain::getById($domainId)->getName();
Toggle::apply($domainName, $action === 'enable');

// Volta para a lista de módulos (onde CustomButtons é renderizado)
header('Location: ' . pm_Context::getModulesListUrl());
exit;
