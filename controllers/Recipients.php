<?php namespace SublimeArts\SublimeChimp\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Recipients Back-end Controller
 */
class Recipients extends Controller
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

        BackendMenu::setContext('SublimeArts.SublimeChimp', 'sublimechimp', 'recipients');
    }
}
