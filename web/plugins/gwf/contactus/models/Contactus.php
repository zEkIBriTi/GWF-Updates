<?php namespace Gwf\Contactus\Models;

use Model;
use BackendAuth;

/**
 * Model
 */
class Contactus extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Sluggable;
    /*
     * Validation
     */
    public $rules = [
        'physical_address' => 'required',
        'post_address' => 'required',
        'email' => 'required',
        'phone' => 'required'
    ];

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;

    protected  $slugs = ['slug' => 'physical_address'];
    
    public $attachOne = [
        'location_map' => 'System\Models\File',
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'gwf_contactus_contactus';

    public function beforeSave()
    {
        $user = BackendAuth::getUser();
        $this->user_id = $user->id;
    }
}