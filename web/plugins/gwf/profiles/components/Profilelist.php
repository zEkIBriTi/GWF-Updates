<?php

namespace Gwf\Profiles\Components;

use Lang;
use Cms\Classes\Page;
use Cms\Classes\ComponentBase;
use RainLab\Builder\Classes\ComponentHelper;
use SystemException;
use Exception;

use Gwf\Profiles\Models\Profiles;

class Profilelist extends ComponentBase
{   
    /**
    * Reference to the page name for linking to details.
    * @var string
    */
    public $detailsPage;

    
    /**
     * Parameter to use for the page number
     * @var string
     */
    public $pageParam;

    /**
     * Name of the details page URL parameter which takes the record identifier.
     * @var string
     */
    public $detailsUrlParameter;

    /**
     * Model column to use as a record identifier in the details page links
     * @var string
     */
    public $detailsKeyColumn;

    public $profilelist;

    public $welcomeNote;

    public function componentDetails()
    {
        return [
            'name'        => 'Profile List',
            'description' => 'List of Profiles'
        ];
    }

    public function defineProperties()
    {
        return [
            'detailsPage' => [
                'title'       => 'rainlab.builder::lang.components.list_details_page',
                'description' => 'rainlab.builder::lang.components.list_details_page_description',
                'type'        => 'dropdown',
                'showExternalParam' => false,
                'group'       => 'rainlab.builder::lang.components.list_detalis_page_link'
            ],
            'detailsKeyColumn' => [
                'title'       => 'rainlab.builder::lang.components.list_details_key_column',
                'description' => 'rainlab.builder::lang.components.list_details_key_column_description',
                'type'        => 'autocomplete',
                'depends'     => ['modelClass'],
                'showExternalParam' => false,
                'group'       => 'rainlab.builder::lang.components.list_detalis_page_link'
            ],
            'detailsUrlParameter' => [
                'title'       => 'rainlab.builder::lang.components.list_details_url_parameter',
                'description' => 'rainlab.builder::lang.components.list_details_url_parameter_description',
                'type'        => 'string',
                'default'     => 'id',
                'showExternalParam' => false,
                'group'       => 'rainlab.builder::lang.components.list_detalis_page_link'
            ],
             'welcomeNote' => [
                'title'       => 'Welcome Note',
                'description' => 'rainlab.builder::lang.components.list_details_page_description',
                'type'        => 'dropdown',
                'showExternalParam' => false,
                'group'       => 'rainlab.builder::lang.components.list_detalis_page_link'
            ],
        ];
    }

    public function  onRun(){
        
        $this->prepareVars();

        $this->profilelist = $this->loadProfiles();
    }

    protected function loadProfiles(){
        return Profiles::where('activation_status',1)->orderby('id','ASC')->limit(2)->get();
    }  

    public function getDetailsPageOptions()
    {
        $pages = Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');

        $pages = [
            '-' => Lang::get('rainlab.builder::lang.components.list_details_page_no')
        ] + $pages;

        return $pages;
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
        $this->pageParam = $this->page['pageParam'] = $this->paramName('pageNumber');

        $this->detailsKeyColumn = $this->page['detailsKeyColumn'] = $this->property('detailsKeyColumn');
        $this->detailsUrlParameter = $this->page['detailsUrlParameter'] = $this->property('detailsUrlParameter');

        $detailsPage = $this->property('detailsPage');
        if ($detailsPage == '-') {
            $detailsPage = null;
        }

        $this->detailsPage = $this->page['detailsPage'] = $detailsPage;

        $welcomeNote = $this->property('welcomeNote');
        if ($welcomeNote == '-') {
            $welcomeNote = null;
        }
        $this->welcomeNote = $this->page['welcomeNote'] = $welcomeNote;

        if (strlen($this->detailsPage)) {
            if (!strlen($this->detailsKeyColumn)) {
                throw new SystemException('The details key column should be set to generate links to the details page.');
            }

            if (!strlen($this->detailsUrlParameter)) {
                throw new SystemException('The details page URL parameter name should be set to generate links to the details page.');
            }
        }
    }
}
