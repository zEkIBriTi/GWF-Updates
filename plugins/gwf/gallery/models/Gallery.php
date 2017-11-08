<?php namespace Gwf\Gallery\Models;

use Model;
use BackendAuth;

/**
 * Model
 */
class Gallery extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Sluggable;

    /*
     * Validation
     */
    public $rules = [
        'title' => 'required',
        'description' => 'required',

    ];

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = true;
    protected $slugs = ['slug' => 'title'];
    /**
     * @var string The database table used by the model.
     */
    public $table = 'gwf_gallery_galleries';

    public $attachMany = [
            'gallery_images' => 'System\Models\File',
    ];


    public function beforeSave(){
        $this->recorder = BackendAuth::getUser()->id;
        
    }

}