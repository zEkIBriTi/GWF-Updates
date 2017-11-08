<?php namespace gwf\Publication\Models;
 
 use Model;
 use gwf\Publication\Models\Publicationcategory;
 
/**
 * Model
 */
class Publication extends Model
{
    use \October\Rain\Database\Traits\Validation;

    use \October\Rain\Database\Traits\Sluggable;

    /*
     * Validation
     */
    public $rules = [
        'title' => 'required',
        'publicationcategory_id' => 'required',
        'document_link' => 'required'
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
    public $table = 'gwf_publication_publications';

    protected $slugs = ['slug' => 'title'];

    public function categories()
    {
        return $this->belongsTo('gwf\Publication\Models\Publicationcategory','publicationcategory_id','id');
    }

    public $hasOne = [
	    'my_relation' => [
	        'gwf\Publication\Models\Publicationcategory',
	        'key' => 'id', // key of the B class (B.id)
	        'otherKey' => 'publicationcategory_id' // column of the A model that references B (A.model_b_id)
	    ]
	];

    public function getPublicationcategoryIdOptions()
    {
    	return Publicationcategory::where('status',1)->lists('title','id');
    }

    public $attachOne=[
    	'document_link' => 'System\Models\File'
    ];
}