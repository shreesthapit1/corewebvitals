<?php

namespace Shreesthapit\Corewebvitals;

class CoreWebVitalComputation
{
    const CLS_GREAT_LESS_THAN = 0.1;
    const CLS_NEED_IMPROVEMENT_LESS_THAN = 0.25;
    const CLS_UPMOST_VALUE_LESS_THAN = 1;

    const LCP_GREAT_LESS_THAN = 2.5;
    const LCP_NEED_IMPROVEMENT_LESS_THAN = 4;
    const LCP_UPMOST_VALUE_LESS_THAN = 10;

    const FCP_GREAT_LESS_THAN = 1.8;
    const FCP_NEED_IMPROVEMENT_LESS_THAN = 3;
    const FCP_UPMOST_VALUE_LESS_THAN = 7;

    public function getDateRange($date_range = null)
    {
        $date_to = date('Y-m-d');
        $date_from = date('Y-m-d', strtotime('-1 month'));
        if (!empty($date_range)) {
            $dateRange = explode('-', $date_range);
            $date_from = trim($dateRange[0]);
            $date_to = trim($dateRange[1]);
            $date_from = date('Y-m-d', strtotime($date_from));
            $date_to = date('Y-m-d', strtotime($date_to));
        }
        return [
            'date_from' => $date_from,
            'date_to' => $date_to,
        ];
    }

    public function groupCoreWebVitalByDate($core_web_vital_url_records)
    {
        return $core_web_vital_url_records->groupBy('date');
    }

    public function groupCoreWebVitalByUrl($core_web_vital_url_records)
    {
        return $core_web_vital_url_records->groupBy('core_web_vital_url_id');
    }

    public function averageVitalRecordsByDate($core_web_vital_url_records_by_date): array
    {
        $daily_average_cls_records = $daily_average_lcp_records = $daily_average_fcp_records = [];
        foreach ($core_web_vital_url_records_by_date as $date => $record) {
            $daily_average_cls_records[] = [
                $date,
                $record->avg('cls')];
            $daily_average_lcp_records[] = [
                $date,
                round($record->avg('lcp'), 2) / 100];
            $daily_average_fcp_records[] = [
                $date,
                round($record->avg('fcp'), 2) / 100];
        }
        return [
            'daily_average_cls_records' => $daily_average_cls_records,
            'daily_average_lcp_records' => $daily_average_lcp_records,
            'daily_average_fcp_records' => $daily_average_fcp_records,
        ];
    }

    public function getClassNameByValues(float $value, float $great_value, float $need_improvement_value): string
    {
        if ($value < $great_value) {
            $cls_progress_bar_class = "bg-success";
        } elseif ($value < $need_improvement_value) {
            $cls_progress_bar_class = "bg-warning";
        } else {
            $cls_progress_bar_class = "bg-danger";
        }
        return $cls_progress_bar_class;
    }

    public function getVitalsPerformancePercentage(float $value, float $great_value, float $need_improvement_value, float $upmost_value): float
    {
        if ($value < $great_value) {
            //80 to 100
            $difference = $great_value - $value;
            $percentage = ($difference / $great_value) * 100;
            $percentage = 80 + ($percentage / 100) * 20;
        } elseif ($value < $need_improvement_value) {
            //40 to 79
            $difference = $need_improvement_value - $value;
            $percentage = ($difference / ($need_improvement_value - $great_value)) * 100;
            $percentage = 40 + ($percentage / 100) * 39;
        } else {
            //10 to 39
            $difference = $upmost_value - $value;
            $percentage = ($difference / ($upmost_value - $need_improvement_value)) * 100;
            $percentage = 10 + ($percentage / 100) * 29;
        }
        if ($percentage < 0) {
            $percentage = 0;
        }
        return round($percentage, 2);
    }
}
