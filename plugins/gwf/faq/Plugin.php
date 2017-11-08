<?php namespace Gwf\Faq;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
    	return [
    		'Gwf\Faq\Components\Faqlist' => 'Faqlist',
    	];
    }

    public function registerSettings()
    {
    	
    }
}
