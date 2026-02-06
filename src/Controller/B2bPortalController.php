<?php

declare(strict_types=1);

namespace Drupal\commerce_b2b_portal_demo\Controller;

use Drupal\commerce_b2b_portal_demo\PortalSummaryBuilder;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Session\AccountProxyInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

final class B2bPortalController extends ControllerBase
{
    private AccountProxyInterface $currentUser;
    private ConfigFactoryInterface $configFactory;
    private PortalSummaryBuilder $summaryBuilder;

    public function __construct(
        AccountProxyInterface $current_user,
        ConfigFactoryInterface $config_factory,
        PortalSummaryBuilder $summary_builder
    ) {
        $this->currentUser = $current_user;
        $this->configFactory = $config_factory;
        $this->summaryBuilder = $summary_builder;
    }

    public static function create(ContainerInterface $container): self
    {
        return new self(
            $container->get('current_user'),
            $container->get('config.factory'),
            $container->get('commerce_b2b_portal_demo.summary_builder')
        );
    }

    public function view(): array
    {
        $config = $this->configFactory->get('commerce_b2b_portal_demo.settings');

        $summary = $this->summaryBuilder->build([
            'company_label' => (string) $config->get('company_label'),
            'account_manager_label' => (string) $config->get('account_manager_label'),
            'company' => $this->currentUser->getDisplayName(),
            'account_manager' => 'Assigned by sales',
            'open_orders' => 0,
            'open_total' => '$0.00',
            'support_email' => (string) $config->get('support_email'),
        ]);

        $rows = [];
        foreach ($summary['highlights'] as $item) {
            $rows[] = [$item['label'], $item['value']];
        }

        return [
            '#type' => 'container',
            'intro' => [
                '#markup' => '<p>Welcome to your B2B portal. Use this space to surface company pricing, invoices, '
                    . 'and open orders.</p>',
            ],
            'summary' => [
                '#type' => 'table',
                '#header' => ['Item', 'Value'],
                '#rows' => $rows,
                '#empty' => $this->t('No summary data available.'),
            ],
        ];
    }
}
