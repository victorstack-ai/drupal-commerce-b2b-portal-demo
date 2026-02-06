<?php

declare(strict_types=1);

namespace Drupal\commerce_b2b_portal_demo\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

final class B2bPortalSettingsForm extends ConfigFormBase
{
    public function getFormId(): string
    {
        return 'commerce_b2b_portal_demo_settings_form';
    }

    protected function getEditableConfigNames(): array
    {
        return ['commerce_b2b_portal_demo.settings'];
    }

    public function buildForm(array $form, FormStateInterface $form_state): array
    {
        $config = $this->config('commerce_b2b_portal_demo.settings');

        $form['company_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Company label'),
            '#default_value' => $config->get('company_label'),
            '#required' => true,
        ];

        $form['account_manager_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Account manager label'),
            '#default_value' => $config->get('account_manager_label'),
            '#required' => true,
        ];

        $form['support_email'] = [
            '#type' => 'email',
            '#title' => $this->t('Support email'),
            '#default_value' => $config->get('support_email'),
            '#description' => $this->t('Optional contact for portal users.'),
        ];

        return parent::buildForm($form, $form_state);
    }

    public function submitForm(array &$form, FormStateInterface $form_state): void
    {
        parent::submitForm($form, $form_state);

        $this->config('commerce_b2b_portal_demo.settings')
            ->set('company_label', $form_state->getValue('company_label'))
            ->set('account_manager_label', $form_state->getValue('account_manager_label'))
            ->set('support_email', $form_state->getValue('support_email'))
            ->save();
    }
}
