<?php namespace SublimeArts\SublimeChimp\Models;

use Model;

/**
 * Recipient Model
 */
class Recipient extends Model
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'sa_sublimechimp_recipients';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [
        'name',
        'email',
        'record_id',
        'record_class'
    ];

    /**
     * @var array Relations
     */
    public $belongsToMany = [
        'mailingLists' => [ 'SublimeArts\ChimpMailing\Models\MailingList' ],
        'mailingLists_count' => [ 'SublimeArts\ChimpMailing\Models\MailingList', 'count' => 'true' ]
    ];
}
