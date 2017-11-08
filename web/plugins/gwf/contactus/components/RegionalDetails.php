<?php

namespace Gwf\Contactus\Components;

use Lang;
use Cms\Classes\ComponentBase;
use RainLab\Builder\Classes\ComponentHelper;;
use SystemException;
use Gwf\Contactus\Models\Contactus;

class RegionalDetails extends ComponentBase
{
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

    public $contactinfo;

    public function componentDetails()
    {
        return [
            'name'        => 'Regional Details',
            'description' => 'Regional Contact info'
        ];
    }

     public function defineProperties()
    {
        return [
            
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
            ]
        ];
    }


    public function  onRun(){
        $this->prepareVars();
        $this->contactinfo = $this->loadContactInfo();
    }

    protected function loadContactInfo(){
        if (!strlen($this->identifierValue)) {
            return;
        }
        return Contactus::where($this->modelKeyColumn, '=', $this->identifierValue)->first();
    } 


    protected function prepareVars()
    {
        $this->notFoundMessage = $this->page['notFoundMessage'] = Lang::get($this->property('notFoundMessage'));
        $this->modelKeyColumn = $this->page['modelKeyColumn'] = $this->property('modelKeyColumn');
        $this->identifierValue = $this->page['identifierValue'] = $this->property('identifierValue');

        if (!strlen($this->modelKeyColumn)) {
            throw new SystemException('The model key column name is not set.');
        }
    } 
}

