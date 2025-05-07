<?php
// namespace Plesk\Module\ToggleLitespeed\Hooks;

use pm_Hook_CustomButtons;
use pm_Context;
use pm_Domain;
use Plesk\Module\ToggleLitespeed\Toggle;

class Modules_ToggleLitespeed_CustomButtons extends pm_Hook_CustomButtons
{
    public function getButtons()
    {
        $buttons = [];

        // lê o parâmetro 'id' que o Plesk injeta via contextParams
        $domainId = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        if ($domainId) {
            // Carrega o domínio e nome
            $domain = pm_Domain::getById($domainId);
            $name   = $domain->getName();

            // Verifica estado atual
            $enabled = Toggle::isEnabled($name);

            // Define ação inversa e título
            $action = $enabled ? 'disable' : 'enable';
            $title  = $enabled ? 'Desativar LiteSpeed' : 'Ativar LiteSpeed';

            // Monta o link que chama seu toggle.php
            $link = pm_Context::getBaseUrl()
                  . 'toggle.php'
                  . '?action='   . $action
                  . '&domain='   . urlencode($name)
                  . '&domainId=' . $domainId;

            $buttons[] = [
                'place'       => self::PLACE_COMMON,
                'title'       => $title,
                'description' => "$title neste domínio",
                'link'        => $link,
                'icon'        => pm_Context::getBaseUrl() . 'images/icon.svg',
            ];
        } 

        return $buttons;
    }
}
