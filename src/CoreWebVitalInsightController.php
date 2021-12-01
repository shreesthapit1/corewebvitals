<?php

namespace Shreesthapit\Corewebvitals;

use App\Http\Controllers\Controller;
use Shreesthapit\Corewebvitals\CoreWebVitalUrl;
use Illuminate\Http\Request;

class CoreWebVitalInsightController extends Controller
{
    public function insight(Request $request, CoreWebVitalComputation $coreWebVitalComputation)
    {
        $dateResponse = $coreWebVitalComputation->getDateRange($request->daterange);
        $date_from = $dateResponse['date_from'];
        $date_to = $dateResponse['date_to'];

        $core_web_vital_url_records = new CoreWebVitalUrlRecord();
        $core_web_vital_url_records = $core_web_vital_url_records->where('date', '>=', $date_from)->where('date', '<=', $date_to)->with('coreWebVitalUrl')->orderBy('date')->get();

        $core_web_vital_url_records_by_url = $coreWebVitalComputation->groupCoreWebVitalByUrl($core_web_vital_url_records);

        $core_web_vital_url_records_by_date = $coreWebVitalComputation->groupCoreWebVitalByDate($core_web_vital_url_records);
        $averageVitalRecords = $coreWebVitalComputation->averageVitalRecordsByDate($core_web_vital_url_records_by_date);
        $daily_average_cls_records = $averageVitalRecords['daily_average_cls_records'];
        $daily_average_lcp_records = $averageVitalRecords['daily_average_lcp_records'];
        $daily_average_fcp_records = $averageVitalRecords['daily_average_fcp_records'];

        $cls_value = round($core_web_vital_url_records->avg('cls'), 2);
        $lcp_value = round($core_web_vital_url_records->avg('lcp') / 100, 2);
        $fcp_value = round($core_web_vital_url_records->avg('fcp') / 100, 2);

        $cls_progress_bar_class = $coreWebVitalComputation->getClassNameByValues($cls_value, CoreWebVitalComputation::CLS_GREAT_LESS_THAN, CoreWebVitalComputation::CLS_NEED_IMPROVEMENT_LESS_THAN);

        $cls_percentage = $coreWebVitalComputation->getVitalsPerformancePercentage($cls_value, CoreWebVitalComputation::CLS_GREAT_LESS_THAN, CoreWebVitalComputation::CLS_NEED_IMPROVEMENT_LESS_THAN, CoreWebVitalComputation::CLS_UPMOST_VALUE_LESS_THAN);

        $lcp_progress_bar_class = $coreWebVitalComputation->getClassNameByValues($lcp_value, CoreWebVitalComputation::LCP_GREAT_LESS_THAN, CoreWebVitalComputation::LCP_NEED_IMPROVEMENT_LESS_THAN);

        $lcp_percentage = $coreWebVitalComputation->getVitalsPerformancePercentage($lcp_value, CoreWebVitalComputation::LCP_GREAT_LESS_THAN, CoreWebVitalComputation::LCP_NEED_IMPROVEMENT_LESS_THAN, CoreWebVitalComputation::LCP_UPMOST_VALUE_LESS_THAN);

        $fcp_progress_bar_class = $coreWebVitalComputation->getClassNameByValues($lcp_value, CoreWebVitalComputation::FCP_GREAT_LESS_THAN, CoreWebVitalComputation::FCP_NEED_IMPROVEMENT_LESS_THAN);

        $fcp_percentage = $coreWebVitalComputation->getVitalsPerformancePercentage($lcp_value, CoreWebVitalComputation::FCP_GREAT_LESS_THAN, CoreWebVitalComputation::FCP_NEED_IMPROVEMENT_LESS_THAN, CoreWebVitalComputation::FCP_UPMOST_VALUE_LESS_THAN);


        $data['core_web_vital_url_records'] = $core_web_vital_url_records;
        $data['cls_value'] = $cls_value;
        $data['cls_progress_bar_class'] = $cls_progress_bar_class;
        $data['cls_percentage'] = $cls_percentage;
        $data['lcp_value'] = $lcp_value;
        $data['lcp_progress_bar_class'] = $lcp_progress_bar_class;
        $data['lcp_percentage'] = $lcp_percentage;
        $data['fcp_value'] = $fcp_value;
        $data['fcp_progress_bar_class'] = $fcp_progress_bar_class;
        $data['fcp_percentage'] = $fcp_percentage;
        $data['daily_average_cls_records'] = $daily_average_cls_records;
        $data['daily_average_lcp_records'] = $daily_average_lcp_records;
        $data['daily_average_fcp_records'] = $daily_average_fcp_records;
        $data['core_web_vital_url_records_by_url'] = $core_web_vital_url_records_by_url;
        $data['date_from'] = $date_from;
        $data['date_to'] = $date_to;

        return view('corewebvitals::core-web-vital.insight', $data);
    }
}
