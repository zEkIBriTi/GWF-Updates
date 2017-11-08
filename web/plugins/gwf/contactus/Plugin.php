<?php namespace Gwf\Contactus;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
    	return [
    		'Gwf\Contactus\Components\ContactusDetails' => 'ContactusDetails',
    		'Gwf\Contactus\Components\ContactForm' => 'ContactForm',
            'Gwf\Contactus\Components\RegionalDetails' => 'RegionalDetails',
            'Gwf\Contactus\Components\ContactusList' => 'ContactusList',
    	];
    }

    public function registerSettings()
    {
    }
}
