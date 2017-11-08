<?php namespace Gwf\EconomicActivities\Models;

use Model;
use BackendAuth;

/**
 * Model
 */
class EconomicActivity extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Sluggable;

    /*
     * Validation
     */
    public $rules = [
        'activityname' => 'required',
        'description' => 'required'
    ];

    public $implement =['RainLab.Translate.Behaviors.TranslatableModel'];

    public $translatable = ['activityname','description'];

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'gwf_economicactivities_';

    protected $slugs = ['slug' => 'activityname'];

    public function beforeSave(){

        $user = BackendAuth::getUser();
        $this ->recorder = $user->id;
    }
}