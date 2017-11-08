<?php

namespace Gwf\Faq\Components;

use Lang;

use Cms\Classes\ComponentBase;

use Gwf\Faq\Models\Faq;

class Faqlist extends ComponentBase
{
    public $faqs;

    public function componentDetails()
    {
        return [
            'name'        => 'Faqs List',
            'description' => 'List of Faqs'
        ];
    }

    public function  onRun(){
        
        $this->faqs = $this->loadFaqs();
    }

    protected function loadFaqs(){
        return Faq::all();
    }  
}
