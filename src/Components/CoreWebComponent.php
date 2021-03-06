<?php

namespace Shreesthapit\Corewebvitals\Components;

use Illuminate\View\Component;

class CoreWebComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('corewebvitals::components.core-web-component');
    }
}
