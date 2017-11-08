<?php namespace Gwf\Projectandinvestment\Components;

use Lang;
use Cms\Classes\ComponentBase;
use RainLab\Builder\Classes\ComponentHelper;;
use SystemException;
use Gwf\Projectandinvestment\Models\Projectandinvestment;
use Gwf\Projectandinvestment\Models\Category;
use Cms\Classes\Page;

/*use Illuminate\Pagination\LengthAwarePaginator;*/
use Illuminate\Pagination\Paginator;

class Categoryprojects extends ComponentBase
{
    /**
     * A model instance to display
     * @var \October\Rain\Database\Model
     */
    public $detailsPage;

    public $categoryprojects;

    public $recordsPerPage;

    public $detailsUrlParameter;
    /**
     * Message to display if the record is not found.
     * @var string
     */
    public $notFoundMessage;
    
    /**
     * Model column to display on the details page.
     * @var string
     */
    public $displayColumn;
    
    /**
     * Model column to use as a record identifier for fetching the record from the database.
     * @var string
     */
    public $modelKeyColumn;
    
    /**
     * Identifier value to load the record from the database.
     * @var string
     */
    public $identifierValue;

    public $pi_category_title;

    public function componentDetails()
    {
        return [
            'name'        => 'Projects and Investment by Category',
            'description' => 'List of Projects and Investments by category'
        ];
    }

    //
    // Properties
    //

    public function defineProperties()
    {
            return [
           /* 'modelClass' => [
                'title'       => 'rainlab.builder::lang.components.details_model',
                'type'        => 'dropdown',
                'showExternalParam' => false
            ],*/
            'detailsPage' => [
                'title'       => 'rainlab.builder::lang.components.list_details_page',
                'description' => 'rainlab.builder::lang.components.list_details_page_description',
                'type'        => 'dropdown',
                'showExternalParam' => false,
            ],
            'identifierValue' => [
                'title'       => 'rainlab.builder::lang.components.details_identifier_value',
                'description' => 'rainlab.builder::lang.components.details_identifier_value_description',
                'type'        => 'string',
                'default'     => '{{ :id }}',
                'validation'  => [
                    'required' => [
                        'message' => Lang::get('rainlab.builder::lang.components.details_identifier_value_required')
                    ]
                ]
            ],
            'modelKeyColumn' => [
                'title'       => 'rainlab.builder::lang.components.details_key_column',
                'description' => 'rainlab.builder::lang.components.details_key_column_description',
                'type'        => 'autocomplete',
                'default'     => 'id',
                'validation'  => [
                    'required' => [
                        'message' => Lang::get('rainlab.builder::lang.components.details_key_column_required')
                    ]
                ],
                'showExternalParam' => false
            ],
            
            'notFoundMessage' => [
                'title'       => 'rainlab.builder::lang.components.details_not_found_message',
                'description' => 'rainlab.builder::lang.components.details_not_found_message_description',
                'default'     => Lang::get('rainlab.builder::lang.components.details_not_found_message_default'),
                'type'        => 'string',
                'showExternalParam' => false
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
        ];
    }

    public function getModelClassOptions()
    {
        return ComponentHelper::instance()->listGlobalModels();
    }

    public function getDisplayColumnOptions()
    {
        return ComponentHelper::instance()->listModelColumnNames();
    }

    public function getModelKeyColumnOptions()
    {
        return ComponentHelper::instance()->listModelColumnNames();
    }

    //
    // Rendering and processing
    //

    public function onRun()
    {
        $this->prepareVars();

        $this->categoryprojects = $this->loadProjectsByCategory();
    }

    protected function prepareVars()
    {
        $this->notFoundMessage = $this->page['notFoundMessage'] = Lang::get($this->property('notFoundMessage'));
        $this->modelKeyColumn = $this->page['modelKeyColumn'] = $this->property('modelKeyColumn');
        $this->identifierValue = $this->page['identifierValue'] = $this->property('identifierValue');
        $this->pi_category_title = $projects_category = Category::where('slug',$this->identifierValue)->first()->title;
        $this->detailsUrlParameter = $this->page['modelKeyColumn'] = $this->property('modelKeyColumn');

        if (!strlen($this->modelKeyColumn)) {
            throw new SystemException('The model key column name is not set.');
        }

        $detailsPage = $this->property('detailsPage');
        if ($detailsPage == '-') {
            $detailsPage = null;
        }
        $this->detailsPage = $this->page['detailsPage'] = $detailsPage;

        if (strlen($this->detailsPage)) {
            if (!strlen($this->modelKeyColumn)) {
                throw new SystemException('The model key column should be set to generate links to the details page.');
            }

            if (!strlen($this->detailsUrlParameter)) {
                throw new SystemException('The details page URL parameter name should be set to generate links to the details page.');
            }
        }

    }

    protected function loadProjectsByCategory()
    {   
        $recordsPerPage = trim($this->property('recordsPerPage'));
        if (!strlen($recordsPerPage)) {
            // Pagination is disabled - return all records
            $projects_category = Category::where($this->modelKeyColumn, $this->identifierValue)->first()->id;
            return Projectandinvestment::where('projectcategory_id', '=', $projects_category)->orderby('id','DESC')->get();
           /* return Projectandinvestment::get();*/
        }

        $projects_category = Category::where($this->modelKeyColumn, $this->identifierValue)->first()->id;

        $categoryprojects = Projectandinvestment::where('projectcategory_id', '=', $projects_category)->orderby('id','DESC')->paginate($recordsPerPage);
  
        return $categoryprojects;
    }

    public function getDetailsPageOptions()
    {
        $pages = Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');

        $pages = [
            '-' => Lang::get('rainlab.builder::lang.components.list_details_page_no')
        ] + $pages;

        return $pages;
    }
}