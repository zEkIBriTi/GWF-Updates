<?php

namespace Gwf\Dashboardlinks\Components;

use Lang;

use Cms\Classes\ComponentBase;

use Gwf\Dashboardlinks\Models\Dashboardlink;

class Dashboard extends ComponentBase
{
    public $dashboardLinks;

    public function componentDetails()
    {
        return [
            'name'        => 'Dashboard List',
            'description' => 'List of dashboards'
        ];
    }

    public function  onRun(){
        
        $this->dashboardLinks = $this->loadDashboard();
    }

    protected function loadDashboard(){
        return Dashboardlink::all();
    }  
}
