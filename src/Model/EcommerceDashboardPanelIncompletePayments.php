<?php

namespace Sunnysideup\EcommerceDashboard\Model;

use Sunnysideup\Ecommerce\Model\Money\EcommercePayment;

class EcommerceDashboardPanelIncompletePayments extends EcommerceDashboardPanel
{
    private static $icon = 'sunnysideup/ecommerce_dashboard: client/images/icons/EcommerceDashboardPanel_IncompletePayments.png';

    private static $table_name = 'EcommerceDashboardPanelIncompletePayments';

    public function getLabelPrefix()
    {
        return 'Incomplete payments';
    }

    public function getConfiguration()
    {
        return parent::getConfiguration();
    }

    public function Content()
    {
        $html = '';
        $daysBack = $this->calculatedDaysBack();
        $data = $this->calculateOnDaysback($daysBack);
        $html .= $this->formatContentSection($daysBack, $data);

        $daysBack = 9999;
        $data = $this->calculateOnDaysback($daysBack);
        return $html . $this->formatContentSection($daysBack, $data);
    }

    protected function calculateOnDaysback($daysBack)
    {
        $allPayments = EcommercePayment::get()
            ->where('"EcommercePayment"."LastEdited" > ( NOW() - INTERVAL ' . $daysBack . ' DAY )');
        $list = $allPayments->column('Status');
        $total = count($list);
        $totals = [];
        foreach ($list as $status) {
            if (! isset($totals[$status])) {
                $totals[$status] = 0;
            }
            $totals[$status]++;
        }
        return [
            'Total' => $total,
            'Totals' => $totals,
        ];
    }

    protected function formatContentSection($daysBack, $data)
    {
        if ($daysBack > 1000) {
            $html = '<h4 style="padding-top: 30px; clear: both;">From the beginning of time:</h4>';
        } else {
            $html = '<h4>Last ' . $daysBack . ' days:</h4>';
        }
        $html .= '<dl>';
        foreach ($data['Totals'] as $name => $count) {
            $percentage = round($count / $data['Total'], 2) * 100;
            $html .= '
            <dt>' . $name . '</dt>
            <dd>' . $count . ' × = ' . $percentage . '%</dd>';
        }

        return $html;
    }
}
