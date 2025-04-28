<?php
ob_start();
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Filesystem root path for includes
define('ROOT_PATH', __DIR__);

// Web-accessible base path for HTML assets (adjust if deployed in subfolder or root)
define('APP_URL', rtrim(dirname($_SERVER['SCRIPT_NAME']), '/'));
// echo APP_URL;

// Load helper functions
require_once ROOT_PATH . '/Utils/helpers.php';

// Load configuration model
require_once ROOT_PATH . '/Model/Configuration.php';
// Configuration::getConfiguration();

define('IMG_FOLDER', ROOT_PATH . 'Assets/img/');

// map view name to controller
$Controllers = array(
    'HomePage' => 'HomePage',
    'Login' => 'Profile',
    'Inscription' => 'Profile',
    'Deconnecter' => 'Profile',
    'Presentation' => 'SiteInfos',
    'Contact' => 'SiteInfos',
    'Statistiques' => 'Statistiques',
    'Annonce' => 'Annonce',
    'Recherche' => 'Annonce',
    'AllNews' => 'News',
    'News' => 'News',
    'Profile' => 'Profile'
);

$Default_controller = 'HomePage';


#### routing to appropriate Controller
$Vue_name = ($_GET['view'] ?? $Default_controller);
$controller_name = $Controllers[$Vue_name] . 'Controller';
// if (!class_exists($controller_name)) {
//     // If the controller class does not exist, redirect to the default controller
//     $controller_name = $Controllers[$Default_controller] . 'Controller';
//     $Vue_name = $Default_controller;
// }
// load the controller class
require_once(ROOT_PATH . '/Controller' . '/' . $controller_name . '.php');

$c = new $controller_name($Vue_name);
//var_dump($controller_name);
## actions

if (isset($_GET['action'])) {
    //var_dump(explode('&view=',$_SERVER['HTTP_REFERER'])) ;

    $Actions = array(
        'viewImage' => [
            // 'doOutputImage' => $_GET['link'] ?? null
            'viewImage' => $_GET['link'] ?? null
        ],

        'Login' => [
            'doLogin' => $_POST
        ],

        'Inscription' => [
            'doInscription' => $_POST
        ],

        'validerEmail' => [
            'validerInfos' => $_GET['email'] ?? null
        ],

        'Deconnecter' => [
            'doDeconnecter' => null
        ],

        'NewsDetails' => [
            'viewPage' => $_GET['id'] ?? null
        ],

        'AnnonceDetails' => [
            'viewPage' => $_GET['id'] ?? null
        ],

        'Recherche' => [
            'viewPage' => $_POST ?? null
        ],

        'Modif' => [
            'doUpdateProfile' => $_POST ?? null
        ],

        'addAnnonce' => [
            'doAddAnnonce' => $_POST ?? null
        ],

        'Signaler' => [
            'doSignalProfile' => $_REQUEST ?? null
        ],
        'Confirm' => [
            'doConfirmTransaction' => $_GET ?? null
        ],
        'Note' => [
            'doNoteTransaction' => $_REQUEST ?? null
        ],
        'ProposerTransaction' => [
            'doSugguestTransaction' => $_REQUEST ?? null
        ],
        'SupprimerAnnonce' => [
            'doArchiveAnnonce' => $_GET['id'] ?? null
        ],
        'ModifierAnnonce' => [
            'doModifierAnnonce' => $_REQUEST ?? null
        ],
        'ModifierTrajet' => [
            'doUpdateTrajet' => $_REQUEST ?? null
        ],
        'SupprimerTrajet' => [
            'doRemoveTrajet' => $_REQUEST ?? null
        ],
        'addTrajet' => [
            'doAddTrajet' => $_REQUEST ?? null
        ]

    );
    ## call methods
    foreach ($Actions[$_GET['action']] as $method => $params) {
        if ($params !== null) {
            //var_dump($Actions[$_GET['action']]) ;
            //var_dump($method) ;
            //var_dump($params) ;
            $c->$method($params);
        } else {
            $c->$method();
        }
    }
} else { ## go to controller view
    $c->viewPage();
}

ob_end_flush();
