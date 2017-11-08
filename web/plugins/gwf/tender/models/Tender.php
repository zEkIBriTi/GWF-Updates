<?php namespace Gwf\Tender\Models;

use Model;
use BackendAuth;

/**
 * Model
 */
class Tender extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Sluggable;

    public $implement =['RainLab.Translate.Behaviors.TranslatableModel'];

    public $translatable = ['title'];
    /*
     * Validation
     */

    public $rules = [
        'title' => 'required',
        'expire_date' => 'required',
    ];

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = true;

    protected $slugs = ['slug' => 'title'];

    public $attachOne = [
        'tender_file' => 'System\Models\File'
    ];



    /**
     * @var string The database table used by the model.
     */
    public $table = 'gwf_tender_tender';

    public function beforeSave(){
        $this->recorder = BackendAuth::getUser()->id;   
    }
}