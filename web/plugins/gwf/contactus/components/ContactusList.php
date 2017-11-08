<?php

namespace Gwf\Contactus\Components;

use Lang;

use Cms\Classes\ComponentBase;
use Cms\Classes\Page;
use Gwf\Contactus\Models\Contactus;
use RainLab\Builder\Classes\ComponentHelper;
use SystemException;
use Exception;

class ContactusList extends ComponentBase
{
    /**
    * Reference to the page name for linking to details.
    * @var string
    */
    public $detailsPage;

    public $viewAll;

    
    /**
     * Parameter to use for the page number
     * @var string
     */
    public $pageParam;

    /**
     * Message to display when there are no records.
     * @var string
     */
    public $noRecordsMessage;

    /**
     * Specifies the current page number.
     * @var integer
     */
    public $pageNumber;

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

    public $contactinfo;

    public function componentDetails()
    {
        return [
            'name'        => 'Contacts List',
            'description' => 'Contactus Regionals info'
        ];
    }

     public function defineProperties()
    {
        return [

            'noRecordsMessage' => [
                'title'        => 'rainlab.builder::lang.components.list_no_records',
                'description'  => 'rainlab.builder::lang.components.list_no_records_description',
                'type'         => 'string',
                'default'      => Lang::get('rainlab.builder::lang.components.list_no_records_default'),
                'showExternalParam' => false,
            ],
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
            'recordsPerPage' => [
                'title'             => 'rainlab.builder::lang.components.list_records_per_page',
                'description'       => 'rainlab.builder::lang.components.list_records_per_page_description',
                'type'              => 'string',
                'validationPattern' => '^[0-9]*$',
                'validationMessage' => 'rainlab.builder::lang.components.list_records_per_page_validation',
                'group'             => 'rainlab.builder::lang.components.list_pagination'
            ],
            'pageNumber' => [
                'title'       => 'rainlab.builder::lang.components.list_page_number',
                'description' => 'rainlab.builder::lang.components.list_page_number_description',
                'type'        => 'string',
                'default'     => '{{ :page }}',
                'group'       => 'rainlab.builder::lang.components.list_pagination'
            ]
        ];
    }

    public function  onRun(){

        $this->prepareVars();
        $this->contactinfo = $this->loadContactInfo();
    }

    protected function loadContactInfo(){
        return Contactus::all();
    }

    public function getDetailsPageOptions()
    {
        $pages = Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');

        $pages = [
            '-' => Lang::get('rainlab.builder::lang.components.list_details_page_no')
        ] + $pages;

        return $pages;
    }

    public function getViewAllOptions()
    {
        $pages = Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');

        $pages = [
            '-' => Lang::get('rainlab.builder::lang.components.list_details_page_no')
        ] + $pages;

        return $pages;
    }


    protected function prepareVars()
    {
        $this->noRecordsMessage = $this->page['noRecordsMessage'] = Lang::get($this->property('noRecordsMessage'));
        $this->displayColumn = $this->page['displayColumn'] = $this->property('displayColumn');
        $this->pageParam = $this->page['pageParam'] = $this->paramName('pageNumber');

        $this->detailsKeyColumn = $this->page['detailsKeyColumn'] = $this->property('detailsKeyColumn');
        $this->detailsUrlParameter = $this->page['detailsUrlParameter'] = $this->property('detailsUrlParameter');

        $detailsPage = $this->property('detailsPage');
        if ($detailsPage == '-') {
            $detailsPage = null;
        }

        $this->detailsPage = $this->page['detailsPage'] = $detailsPage;

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

