<?php namespace SublimeArts\SublimeChimp\Models;

use SublimeArts\SublimeChimp\Classes\SublimeChimp\BaseModel;

/**
 * Template Model
 */
class Template extends BaseModel
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'sa_sublimechimp_templates';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];
}
