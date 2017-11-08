<?php

namespace Gwf\Announcements\Components;


use Lang;
use Cms\Classes\Page;
use Cms\Classes\ComponentBase;
use RainLab\Builder\Classes\ComponentHelper;
use SystemException;
use Exception;

use Gwf\Announcements\Models\Announcements;


 
class Announcement extends ComponentBase
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

    public $announcements;

    public function componentDetails()
    {
        return [
            'name'        => 'Announcements List',
            'description' => 'List of Announcements'
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
            'viewAll' => [
                'title'       => 'View All',
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

        $this->announcements = $this->page['announcements'] = $this->loadAnnouncements();
    }

    protected function loadAnnouncements(){

        $recordsPerPage = trim($this->property('recordsPerPage'));
        if (!strlen($recordsPerPage)) {
            // Pagination is disabled - return all records
            return Announcements::get();
        }

        if (!preg_match('/^[0-9]+$/', $recordsPerPage)) {
            throw new SystemException('Invalid records per page value.');
        }

        $pageNumber = trim($this->property('pageNumber'));
        if (!strlen($pageNumber) || !preg_match('/^[0-9]+$/', $pageNumber)) {
            $pageNumber = 1;
        }
        
        return Announcements::where('activation_status',1)->orderby('id','DESC')->paginate($recordsPerPage, $pageNumber);
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


        $viewAll = $this->property('viewAll');
        if ($viewAll == '-') {
            $viewAll = null;
        }
        $this->viewAll = $this->page['viewAll'] = $viewAll;

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
