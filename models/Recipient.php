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
     * All of the relationships to be touched.
     */
    protected $touches = ['mailingLists'];

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
        'mailingLists' => [ 
            'SublimeArts\SublimeChimp\Models\MailingList',
            'table' => 'sa_mailing_list_recipient'
        ],
        'mailingLists_count' => [
            'SublimeArts\SublimeChimp\Models\MailingList', 
            'table' => 'sa_mailing_list_recipient',
            'count' => 'true' 
        ]
    ];
}
