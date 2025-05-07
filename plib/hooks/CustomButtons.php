<?php
class Modules_ToggleLitespeed_CustomButtons extends pm_Hook_CustomButtons
{
    public function getButtons()
    {
        return [
            [
                'place' => self::PLACE_DOMAIN,
                'title' => 'Alternar LiteSpeed',
                'description' => 'Ative ou desative o LiteSpeed para este domínio.',
                'link' => pm_Context::getBaseUrl() . 'index.php',
                'icon' => pm_Context::getBaseUrl() . 'images/icon.svg',
            ],
            [
                'place' => self::PLACE_CUSTOMER_HOME,
                'title' => 'Alternar LiteSpeed',
                'description' => 'Gerencie o LiteSpeed para seus domínios.',
                'link' => pm_Context::getBaseUrl() . 'index.php',
                'icon' => pm_Context::getBaseUrl() . 'images/icon.svg',
            ],
        ];
    }
}
