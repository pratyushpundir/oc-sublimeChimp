<?php namespace SublimeArts\SublimeChimp\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Mailing Lists Back-end Controller
 */
class MailingLists extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('SublimeArts.SublimeChimp', 'sublimechimp', 'mailinglists');
    }
}
