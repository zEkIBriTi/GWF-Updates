<?php namespace Gwf\Tender\Components;

use Lang;
use Cms\Classes\Page;
use Cms\Classes\ComponentBase;
use Gwf\Tender\Models\Tender;
use RainLab\Builder\Classes\ComponentHelper;
use SystemException;
use Exception;

class TenderList extends ComponentBase
{
    /**
     * A collection of records to display
     * @var \October\Rain\Database\Collection
     */
    public $tender;

    public $recordsPerPage;

    /**
     * Message to display when there are no records.
     * @var string
     */
    public $noRecordsMessage;

    /**
     * Reference to the page name for linking to details.
     * @var string
     */
    public $detailsPage;

    /**
     * Specifies the current page number.
     * @var integer
     */
    public $pageNumber;

    /**
     * Parameter to use for the page number
     * @var string
     */
    public $pageParam;

    /**
     * Model column name to display in the list.
     * @var string
     */
    public $displayColumn; 

    /**
     * Model column to use as a record identifier in the details page links
     * @var string
     */
    public $detailsKeyColumn;

    /**
     * Name of the details page URL parameter which takes the record identifier.
     * @var string
     */
    public $detailsUrlParameter;

    public function componentDetails()
    {
        return [
            'name'        => 'Tender',
            'description' => 'View all tender'
        ];
    }
    //
    // Properties
    //

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
            ],
            'sortColumn' => [
                'title'       => 'rainlab.builder::lang.components.list_sort_column',
                'description' => 'rainlab.builder::lang.components.list_sort_column_description',
                'type'        => 'autocomplete',
                'depends'     => ['modelClass'],
                'group'       => 'rainlab.builder::lang.components.list_sorting',
                'showExternalParam' => false
            ],
            'sortDirection' => [
                'title'       => 'rainlab.builder::lang.components.list_sort_direction',
                'type'        => 'dropdown',
                'showExternalParam' => false,
                'group'       => 'rainlab.builder::lang.components.list_sorting',
                'options'     => [
                    'asc'     => 'rainlab.builder::lang.components.list_order_direction_asc',
                    'desc'    => 'rainlab.builder::lang.components.list_order_direction_desc'
                ]
            ]
        ];
    }

    public function getDetailsPageOptions()
    {
        $pages = Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');

        $pages = [
            '-' => Lang::get('rainlab.builder::lang.components.list_details_page_no')
        ] + $pages;

        return $pages;
    }

    /*public function getModelClassOptions()
    {
        return ComponentHelper::instance()->listGlobalModels();
    }*/

    public function getDisplayColumnOptions()
    {
        return ComponentHelper::instance()->listModelColumnNames();
    }

    public function getDetailsKeyColumnOptions()
    {
        return ComponentHelper::instance()->listModelColumnNames();
    }

    public function getSortColumnOptions()
    {
        return ComponentHelper::instance()->listModelColumnNames();
    }

    public function onRun()
    {
        $this->prepareVars();

        $this->tender = $this->listRecords();
    }

    protected function prepareVars()
    {
        $this->noRecordsMessage = $this->page['noRecordsMessage'] = Lang::get($this->property('noRecordsMessage'));
        
        $this->pageParam = $this->page['pageParam'] = $this->paramName('pageNumber');

        $detailsPage = $this->property('detailsPage');
        if ($detailsPage == '-') {
            $detailsPage = null;
        }
    }

    protected function listRecords()
    {
        $recordsPerPage = trim($this->property('recordsPerPage'));
        if (!strlen($recordsPerPage)) {
            // Pagination is disabled - return all records
            return Tender::get();
        }

        $recordsPerPage = trim($this->property('recordsPerPage'));
        if (!preg_match('/^[0-9]+$/', $recordsPerPage)) {
            throw new SystemException('Invalid records per page value.');
        }

        $pageNumber = trim($this->property('pageNumber'));
        if (!strlen($pageNumber) || !preg_match('/^[0-9]+$/', $pageNumber)) {
            $pageNumber = 1;
        }

        return Tender::where('activation_status', 1)->orderby('id','DESC')->paginate($recordsPerPage, $pageNumber);
    }

    protected function getScopeName($model)
    {
        $scopeMethod = trim($this->property('scope'));
        if (!strlen($scopeMethod) || $scopeMethod == '-') {
            return null;
        }

        if (!preg_match('/scope[A-Z].+/', $scopeMethod)) {
            throw new SystemException('Invalid scope method name.');
        }

        if (!method_exists($model, $scopeMethod)) {
            throw new SystemException('Scope method not found.');
        }

        return lcfirst(substr($scopeMethod, 5));
    }

}