<?php

namespace Shreesthapit\Corewebvitals;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoreWebVitalUrlRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'core_web_vital_url_id',
        'cls',
        'lcp',
        'fcp',
        'fdi',
        'date',
    ];

    public function coreWebVitalUrl()
    {
        return $this->belongsTo(CoreWebVitalUrl::class);
    }
}
