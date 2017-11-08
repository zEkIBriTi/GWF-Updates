<?php namespace Gwf\Publication\Components;

use Lang;
use Cms\Classes\ComponentBase;
use RainLab\Builder\Classes\ComponentHelper;;
use SystemException;
use Gwf\Publication\Models\Publication;
use Gwf\Publication\Models\Publicationcategory;

/*use Illuminate\Pagination\LengthAwarePaginator;*/
use Illuminate\Pagination\Paginator;

class PublicationDetails extends ComponentBase
{
    /**
     * A model instance to display
     * @var \October\Rain\Database\Model
     */
    public $publication;

    public $recordsPerPage;
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

    public $publicationcat_title;

    public function componentDetails()
    {
        return [
            'name'        => 'Publications list',
            'description' => 'List of publications for a specific category'
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

        $this->publication = $this->loadPublication();
    }

    protected function prepareVars()
    {
        $this->notFoundMessage = $this->page['notFoundMessage'] = Lang::get($this->property('notFoundMessage'));
        $this->modelKeyColumn = $this->page['modelKeyColumn'] = $this->property('modelKeyColumn');
        $this->identifierValue = $this->page['identifierValue'] = $this->property('identifierValue');
        $this->publicationcat_title = $publication_cat = Publicationcategory::where('slug',$this->identifierValue)->first()->title;
        
        if (!strlen($this->modelKeyColumn)) {
            throw new SystemException('The model key column name is not set.');
        }
    }

    protected function loadPublication()
    {   
        $recordsPerPage = trim($this->property('recordsPerPage'));
        if (!strlen($recordsPerPage)) {
            // Pagination is disabled - return all records
            $publication_cat = Publicationcategory::where($this->modelKeyColumn, $this->identifierValue)->first()->id;
            return Publication::where('publicationcategory_id', '=', $publication_cat)->orderby('id','DESC')->get();
           /* return Publication::get();*/
        }

       /* $recordsPerPage = trim($this->property('recordsPerPage'));
        if (!preg_match('/^[0-9]+$/', $recordsPerPage)) {
            throw new SystemException('Invalid records per page value.');
        }

        $pageNumber = trim($this->property('pageNumber'));
        if (!strlen($pageNumber) || !preg_match('/^[0-9]+$/', $pageNumber)) {
            $pageNumber = 1;
        }

        if (!strlen($this->identifierValue)) {
            return;
        }*/
        $publication_cat = Publicationcategory::where($this->modelKeyColumn, $this->identifierValue)->first()->id;

        $publication = Publication::where('publicationcategory_id', '=', $publication_cat)->orderby('id','DESC')->paginate($recordsPerPage);
  
        return $publication;
    }
}