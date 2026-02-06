<?php

declare(strict_types=1);

namespace Drupal\commerce_b2b_portal_demo\Tests\Unit;

use Drupal\commerce_b2b_portal_demo\PortalSummaryBuilder;
use PHPUnit\Framework\TestCase;

final class PortalSummaryBuilderTest extends TestCase
{
    public function testBuildUsesDefaults(): void
    {
        $builder = new PortalSummaryBuilder();
        $summary = $builder->build([]);

        $this->assertSame('Company', $summary['highlights'][0]['label']);
        $this->assertSame('Not assigned', $summary['highlights'][0]['value']);
        $this->assertSame('Account manager', $summary['highlights'][1]['label']);
        $this->assertSame('Unassigned', $summary['highlights'][1]['value']);
        $this->assertSame('0', $summary['highlights'][2]['value']);
        $this->assertSame('0.00', $summary['highlights'][3]['value']);
    }

    public function testBuildOverridesValues(): void
    {
        $builder = new PortalSummaryBuilder();
        $summary = $builder->build([
            'company_label' => 'Organization',
            'company' => 'Acme Manufacturing',
            'account_manager_label' => 'CSM',
            'account_manager' => 'Jordan Lee',
            'open_orders' => 4,
            'open_total' => '$12,400.00',
            'support_email' => 'support@example.com',
        ]);

        $this->assertSame('Organization', $summary['highlights'][0]['label']);
        $this->assertSame('Acme Manufacturing', $summary['highlights'][0]['value']);
        $this->assertSame('CSM', $summary['highlights'][1]['label']);
        $this->assertSame('Jordan Lee', $summary['highlights'][1]['value']);
        $this->assertSame('4', $summary['highlights'][2]['value']);
        $this->assertSame('$12,400.00', $summary['highlights'][3]['value']);
        $this->assertSame('Support', $summary['highlights'][4]['label']);
        $this->assertSame('support@example.com', $summary['highlights'][4]['value']);
    }
}
