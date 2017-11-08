<?php

namespace Gwf\Contactus\Components;

use Lang;

use Cms\Classes\ComponentBase;

use Gwf\Contactus\Models\Contactus;

class ContactusDetails extends ComponentBase
{
    public $contactinfo;

    public function componentDetails()
    {
        return [
            'name'        => 'Contactus Home Details',
            'description' => 'Contactus info'
        ];
    }

    public function  onRun(){
        $this->contactinfo = $this->loadContactInfo();
    }

    protected function loadContactInfo(){
        return Contactus::all();
    }  
}

