<?php namespace gwf\projectandinvestment\Models;

use Model;

/**
 * Model
 */
class Category extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\Sluggable;

    /*
     * Validation
     */
    public $rules = [
        'title' => 'required'
    ];

    public $implement =['RainLab.Translate.Behaviors.TranslatableModel'];

    public $translatable = ['title'];

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = true;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'gwf_projectandinvestment_categories';

    protected $slugs = ['slug' => 'title'];

    public function projectandinvestment()
    {
        return $this->hasMany('gwf\projectandinvestment\Models\projectandinvestment');
    }
}