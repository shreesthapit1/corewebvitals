<?php

namespace Shreesthapit\Corewebvitals;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoreWebVitalUrl extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'is_mobile'
    ];

    public function coreWebVitalUrlRecords()
    {
        return $this->hasMany(CoreWebVitalUrlRecord::class);
    }
}
