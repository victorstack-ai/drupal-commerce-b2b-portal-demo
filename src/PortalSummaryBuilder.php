<?php

declare(strict_types=1);

namespace Drupal\commerce_b2b_portal_demo;

final class PortalSummaryBuilder
{
    /**
     * Build summary data for the portal dashboard.
     *
     * @param array $input
     *   Input data keyed by company, account_manager, open_orders, open_total,
     *   company_label, account_manager_label, support_email.
     *
     * @return array
     *   Summary data keyed by highlights and support_email.
     */
    public function build(array $input): array
    {
        $defaults = [
            'company_label' => 'Company',
            'company' => 'Not assigned',
            'account_manager_label' => 'Account manager',
            'account_manager' => 'Unassigned',
            'open_orders' => 0,
            'open_total' => '0.00',
            'support_email' => '',
        ];

        $data = array_merge($defaults, $input);

        $highlights = [
            [
                'label' => $data['company_label'],
                'value' => $data['company'],
            ],
            [
                'label' => $data['account_manager_label'],
                'value' => $data['account_manager'],
            ],
            [
                'label' => 'Open orders',
                'value' => (string) $data['open_orders'],
            ],
            [
                'label' => 'Open order total',
                'value' => (string) $data['open_total'],
            ],
        ];

        if (!empty($data['support_email'])) {
            $highlights[] = [
                'label' => 'Support',
                'value' => $data['support_email'],
            ];
        }

        return [
            'highlights' => $highlights,
            'support_email' => $data['support_email'],
        ];
    }
}
