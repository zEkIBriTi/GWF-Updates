<?php namespace Gwf\Projectandinvestment\Models;

use Model;

use Gwf\Projectandinvestment\Models\Category;

/**
 * Model
 */
class Projectandinvestment extends Model
{
    use \October\Rain\Database\Traits\Validation;

    use \October\Rain\Database\Traits\Sluggable;


    /*
     * Validation
     */
    public $rules = [
        'title' => 'required',
        'summary' => 'required',
        'projectcategory_id' => 'required'
    ];

    public $implement =['RainLab.Translate.Behaviors.TranslatableModel'];

    public $translatable = ['title','summary'];

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = true;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'gwf_projectandinvestment_projectsandinvestments';

    protected $slugs = ['slug' => 'title'];

    public function categories()
    {
        return $this->belongsTo('gwf\projectandinvestment\Models\Category','projectcategory_id','slug');
    }

    public $hasOne = [
        'my_relation' => [
            'gwf\projectandinvestment\Models\Category',
            'key' => 'id', // key of the B class (B.id)
            'otherKey' => 'projectcategory_id' // column of the A model that references B (A.model_b_id)
        ]
    ];

    public function getProjectcategoryIdOptions()
    {
        return Category::where('activation_status',1)->lists('title','id');
    }

    public $attachOne = [
        'project_file' => 'System\Models\File',
    ];

}