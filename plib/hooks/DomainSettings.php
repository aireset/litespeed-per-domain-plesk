<?php
/**
 * Adiciona checkbox em Domain Settings
 */
class Modules_ToggleLitespeed_Hooks_DomainSettings extends pm_Hook_DomainSettings
{
    public function getForm(pm_Domain $domain)
    {
        $form = new pm_Form_Simple();
        $form->addElement('checkbox', 'enable_litespeed', [
            'label' => 'Ativar LiteSpeed neste domínio',
        ]);
        $form->setDefaults([
            'enable_litespeed' => Modules_ToggleLitespeed_Toggle::isEnabled($domain->getName()),
        ]);
        $form->addControlButtons([
            'sendTitle'  => 'Salvar',
            'cancelLink' => pm_Context::getModulesListUrl(),
        ]);
        return $form;
    }

    public function process(pm_Domain $domain, pm_Form_Simple $form)
    {
        if ($form->isSubmitted() && $form->isValid()) {
            Modules_ToggleLitespeed_Toggle::apply(
                $domain->getName(),
                (bool) $form->getValue('enable_litespeed')
            );
        }
    }
}
