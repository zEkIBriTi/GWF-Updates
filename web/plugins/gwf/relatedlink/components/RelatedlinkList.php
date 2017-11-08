<?php

namespace Gwf\Relatedlink\Components;

use Lang;

use Cms\Classes\ComponentBase;

use Gwf\Relatedlink\Models\Relatedlink;

class RelatedlinkList extends ComponentBase
{
    public $relatedlinks;

    public function componentDetails()
    {
        return [
            'name'        => 'Relatedlink List',
            'description' => 'List of Relatedlink'
        ];
    }

    public function  onRun(){
        
        $this->relatedlinks = $this->loadRelatedlink();
    }

    protected function loadRelatedlink(){
        return Relatedlink::where('activation_status', 1)->get();
    }  
}
