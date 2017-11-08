<?php

namespace Gwf\Quicklink\Components;

use Lang;

use Cms\Classes\ComponentBase;

use Gwf\Quicklink\Models\QuickLink;

class Quicklinks extends ComponentBase
{
    public $quicklinks;

    public function componentDetails()
    {
        return [
            'name'        => 'QuickLinks List',
            'description' => 'List of Quicklinks'
        ];
    }

    public function  onRun(){
        
        $this->quicklinks = $this->loadQuicklink();
    }

    protected function loadQuicklink(){
        return Quicklink::all();
    }  
}
