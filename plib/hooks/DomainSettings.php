<?php
namespace Plesk\Module\ToggleLitespeed\Hooks;

use pm_Domain;
use pm_Form_Simple;
use pm_Context;
use Plesk\Module\ToggleLitespeed\Toggle;

class DomainSettings extends \pm_Hook_DomainSettings
{
    public function getForm(pm_Domain $domain): pm_Form_Simple
    {
        $form = new \pm_Form_Simple();
        $form->addElement('checkbox', 'enable_litespeed', [
            'label' => 'Ativar LiteSpeed neste domínio',
        ]);
        $form->setDefaults([
            'enable_litespeed' => Toggle::isEnabled($domain->getName()),
        ]);
        $form->addControlButtons([
            'sendTitle'  => 'Salvar',
            'cancelLink' => pm_Context::getModulesListUrl(),
        ]);
        return $form;
    }

    public function process(pm_Domain $domain, pm_Form_Simple $form): void
    {
        if ($form->isSubmitted() && $form->isValid()) {
            Toggle::apply(
                $domain->getName(),
                (bool) $form->getValue('enable_litespeed')
            );
        }
    }
}
