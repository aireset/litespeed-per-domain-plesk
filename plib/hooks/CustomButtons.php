<?php
// namespace Plesk\Module\ToggleLitespeed\Hooks;

// use pm_Hook_CustomButtons;
// use pm_Context;
// use pm_Session;
// use pm_Domain;
// use Plesk\Module\ToggleLitespeed\Toggle;

class Modules_ToggleLitespeed_CustomButtons extends pm_Hook_CustomButtons
{
    public function getButtons(): array
    {
        $buttons = [];

        // Inicia sessão e busca o domínio corrente (mesmo se for smb/web/overview/id/55/type/domain)
        $session = new pm_Session();
        $domain  = $session->getCurrentDomain(); 

        // $buttons[] = [
        //     'place' => self::PLACE_COMMON,
        //     'title' => 'Alternar LiteSpeed',
        //     'description' => 'Ative ou desative o LiteSpeed para este domínio.',
        //     'link' => pm_Context::getBaseUrl() . 'index.php',
        //     'icon' => pm_Context::getBaseUrl() . 'images/litespeed-icon.svg',
        // ];
        
        if ($domain->hasHosting() && $domain->isActive()) {
            $domainId   = $domain->getId();
            $domainName = $domain->getName();
            // $enabled    = Toggle::isEnabled($domainName);
            $enabled = Modules_ToggleLitespeed_Toggle::isEnabled($domain->getName());
            // $enabled    = false;
    
            $action = $enabled ? 'disable' : 'enable';
            $title  = $enabled ? 'Desativar LiteSpeed' : 'Ativar LiteSpeed';

            $buttons[] = [
                'place'         => self::PLACE_COMMON,
                'title'         => $title,
                // 'description'  => "$title neste domínio ".Modules_ToggleLitespeed_Toggle::teste('aaaaaa'),
                'description'   => "$title neste domínio ",
                'icon'          => pm_Context::getBaseUrl() . 'images/litespeed-icon.svg',
                'link'          => pm_Context::getBaseUrl() . 'toggle.php?action=' . $action,
                'contextParams' => true
            ];

            $buttons[] = [
                'place'        => self::PLACE_DOMAIN_PROPERTIES_DYNAMIC,
                'section'      => self::SECTION_DOMAIN_PROPS_DYNAMIC_DEV_TOOLS,
                'title'        => $title,
                'description'  => "$title neste domínio",
                'icon' => pm_Context::getBaseUrl() . 'images/litespeed-icon.svg',
                // monta URL só com a action; pm_Session já carrega o domain pra você
                'link'         => pm_Context::getBaseUrl() . 'toggle.php?action=' . $action,
                'contextParams'=> true
            ];
        }

        return $buttons;
    }
}
