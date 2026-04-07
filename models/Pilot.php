<?php namespace Pensoft\Pilots\Models;

use Model;
use Validator;
use BackendAuth;
use October\Rain\Database\Traits\Sortable;
/**
 * Pilot Model
 */
class Pilot extends Model
{
    use \October\Rain\Database\Traits\Revisionable;
    use \October\Rain\Database\Traits\Validation;
    use Sortable;

    /**
     * @var string table associated with the model
     */
    public $table = 'pensoft_pilots_pilots';

    // Add  for revisions limit
    public $revisionableLimit = 200;

    // Add for revisions on particular field
    protected $revisionable = [
        'title',
        'intro',
        'name',
        'objectives',
        'stakeholders',
        'timeline_start',
        'timeline_end',
        'link_to_news',
    ];

    /**
     * @var array guarded attributes aren't mass assignable
     */
    protected $guarded = ['*'];

    /**
     * @var array fillable attributes are mass assignable
     */
    protected $fillable = [
        // 'title',
        // 'intro',
        // 'name',
        // 'stakeholders',
    ];

    /**
     * @var array Translatable fields
     */
    public $translatable = [
        'title',
        'intro',
        'name',
        'objectives',
        'stakeholders',
        'link_to_news',
    ];

    /**
     * @var array rules for validation
     */
    public $rules = [];

    /**
     * @var array Attributes to be cast to native types
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'timeline_start' => 'datetime',
        'timeline_end' => 'datetime',
    ];

    /**
     * @var array jsonable attribute names that are json encoded and decoded from the database
     */
    protected $jsonable = [];

    /**
     * @var array appends attributes to the API representation of the model (ex. toArray())
     */
    protected $appends = [];

    /**
     * @var array hidden attributes removed from the API representation of the model (ex. toArray())
     */
    protected $hidden = [];

    /**
     * @var array hasOne and other relations
     */
    public $hasOne = [];
    public $hasMany = [
    ];
    public $belongsTo = [];
    public $belongsToMany = [
        'contacts' => [
            \Pensoft\CardProfiles\Models\Profiles::class,
            'table' => 'pensoft_pilot_contact_pivot',
            'key' => 'pilot_id',
            'otherKey' => 'contact_id'
        ]
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [
        'revision_history' => [\System\Models\Revision::class, 'name' => 'revisionable']
    ];
    public $attachOne = [];
    public $attachMany = [];

    /**
     * Add translation support to this model, if available.
     */
    public static function boot(): void
    {
        Validator::extend(
            'json',
            function ($attribute, $value, $parameters) {
                json_decode($value);

                return json_last_error() == JSON_ERROR_NONE;
            }
        );

        // Call default functionality (required)
        parent::boot();

        // Check the translate plugin is installed
        if (!class_exists('RainLab\Translate\Behaviors\TranslatableModel')) {
            return;
        }

        // Extend the constructor of the model
        self::extend(
            function ($model) {
                // Implement the translatable behavior
                $model->implement[] = 'RainLab.Translate.Behaviors.TranslatableModel';
            }
        );
    }

    /*
     * Remove duplicates and use unique full name + email for options
     **/
    public static function getContactOptions()
    {
        $contacts = \Pensoft\CardProfiles\Models\Profiles::all()->unique('names')->mapWithKeys(function ($item) {
            return [$item->id => $item->names . ' (' . $item->email . ')'];
        });

        return $contacts->all();
    }

    // Add below function use for get current user details
    public function diff(){
        $history = $this->revision_history;
    }

    public function getRevisionableUser()
    {
        return BackendAuth::getUser()->id;
    }

}
