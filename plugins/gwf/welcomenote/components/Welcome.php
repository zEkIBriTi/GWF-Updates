<?php namespace Gwf\Welcomenote\Components;

use Lang;
use Cms\Classes\ComponentBase;
use Cms\Classes\Page;
use RainLab\Builder\Classes\ComponentHelper;;
use SystemException;
use Gwf\Welcomenote\Models\WelcomeNote;


class Welcome extends ComponentBase
{
    /**
     * A model instance to display
     * @var \October\Rain\Database\Model
     */
    public $welcomenote = null;

    public $welcomeotelink;
    
    /**
     * Message to display if the record is not found.
     * @var string
     */
    public $notFoundMessage;
    

    public function componentDetails()
    {
        return [
            'name'        => 'Welcome Note',
            'description' => 'Show Welcome Note'
        ];
    }

    //
    // Properties
    //

    public function defineProperties()
    {
        return [
            
            'notFoundMessage' => [
                'title'       => 'rainlab.builder::lang.components.details_not_found_message',
                'description' => 'rainlab.builder::lang.components.details_not_found_message_description',
                'default'     => Lang::get('rainlab.builder::lang.components.details_not_found_message_default'),
                'type'        => 'string',
                'showExternalParam' => false
            ],
             'welcomeNote' => [
                'title'       => 'Welcome Note',
                'description' => 'rainlab.builder::lang.components.list_details_page_description',
                'type'        => 'dropdown',
                'showExternalParam' => false,
                'group'       => 'rainlab.builder::lang.components.list_detalis_page_link'
            ]
        ];
    }

    

    //
    // Rendering and processing
    //

    public function onRun()
    {
        $this->prepareVars();

        $this->welcomenote = $this->page['welcomenote'] = $this->loadWelcomenote();
    }

    public function getWelcomeNoteOptions()
    {
        $pages = Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');

        $pages = [
            '-' => Lang::get('rainlab.builder::lang.components.list_details_page_no')
        ] + $pages;

        return $pages;
    }

     protected function prepareVars()
    {
        $welcomeotelink = $this->property('welcomeotelink');
        if ($welcomeotelink == '-') {
            $welcomeotelink = null;
        }
        $this->welcomeotelink = $this->page['welcomeotelink'] = $welcomeotelink;
    }

    protected function loadWelcomenote()
    {
        return WelcomeNote::orderby('id','ASC')->first();
    }
}