<?php namespace gwf\Complains\Models;

use Model;
use BackendAuth;

/**
 * Model
 */
class Complain extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Sluggable;
    /*
     * Validation
     */
    public $rules = [
    ];

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;
    protected $slugs=['slug'=>'title'
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'gwf_complains_';
    public function beforeSave()

    {
   // $this->recorder=BackendAuth::getUser()->id;
      $this->recorder = 1;

    }
    public $attachMany = [
            'attachments'=>'System\Models\File'
           
    ];
}
