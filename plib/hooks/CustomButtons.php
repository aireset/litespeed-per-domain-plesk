<?php
class Modules_ToggleLitespeed_CustomButtons extends pm_Hook_CustomButtons
{
    public function getButtons()
    {
        return [
            [
                'place' => self::PLACE_COMMON ,
                'title' => 'Alternar LiteSpeed',
                'description' => 'Gerencie o LiteSpeed para seus domínios.',
                'link' => pm_Context::getBaseUrl() . 'index.php',
                'icon' => pm_Context::getBaseUrl() . 'images/litespeed-icon.svg',
            ],
        ];
    }
}
