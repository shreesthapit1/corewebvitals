<?php

namespace Shreesthapit\Corewebvitals;

use App\Http\Controllers\Controller;
use Shreesthapit\Corewebvitals\CoreWebVitalUrl;
use Shreesthapit\Corewebvitals\CoreWebVitalUrlRecord;
use Illuminate\Http\Request;

class CoreWebVitalController extends Controller
{
    public function storeCWV(Request $request)
    {
        $input = $request->all();
        $core_web_vital_url_record['url'] = $input['url'];
        $core_web_vital_url_record['is_mobile'] = $input['is_mobile'];
        $core_web_vital_url = CoreWebVitalUrl::firstorCreate($core_web_vital_url_record);
        $input['date'] = date('Y-m-d');
        $input['core_web_vital_url_id'] = $core_web_vital_url->id;
        CoreWebVitalUrlRecord::create($input);
        return response()->json(true);
    }
}
