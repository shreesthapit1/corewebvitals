<?php

Route::post('store-cwv', [Shreesthapit\Corewebvitals\CoreWebVitalController::class, 'storeCWV'])->name('store-cwv');

Route::get('core-web-vital-insight',[Shreesthapit\Corewebvitals\CoreWebVitalInsightController::class,'insight'])->name('cwv-insight');
