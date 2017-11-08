<?php namespace gwf\Howdoi\Models;

use Model;

/**
 * Model
 */
class HowDoI extends Model
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

    public $implement =['RainLab.Translate.Behaviors.TranslatableModel'];

    public $translatable = ['title','description'];

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = true;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'gwf_howdoi_howdoi';

    protected $slugs = ['slug' => 'title'];
}