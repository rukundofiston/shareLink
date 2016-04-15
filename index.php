<?php 
    define('__SHARELINK__',''); 
    session_start();
?>

<?php 
    require_once 'include/data.php';
    require_once 'include/helpers.php'
?>

<?php
    if(isset($_SESSION['utilisateurId'])){
        $_SESSION['utilisateur'] = Utilisateurs_Details($_SESSION['utilisateurId']);
    }
    //print_r($_SESSION);
    //$controleur = 'liens';
    $actionParDefaut = '';
    $page = array(
        'template' => 'aucun',
        'view' => 'aucune',
        'styles' => array(),
        'scripts' => array(),
        'message' => '',
        'order' => '',
        'order_dir' => '',
        'title' => 'Bienvenue sur SherLink'
    );
    
    //print_r($_GET);
    $controleur = ReqParam($_GET, 'controller', 'liens');
    /*if(isset($_GET['controller'])){
        $controleur = $_GET['controller'];
    }*/
    switch($controleur){
        case 'liens' :
            require_once 'controllers/liens.controller.php';
            break;
        case 'utilisateurs' :
            require_once 'controllers/utilisateurs.controller.php';
            break;
        default:
            die('controleur inconnu');
    }
    
    $action = ReqParam($_GET, 'action', $actionParDefaut);
   
    Executer($action);
    
    switch ($page['template']){
        case 'index':
            require_once 'templates/index.template.php';
            break;
        case 'application':
            require_once 'templates/application.template.php';
            break;
        case 'commentaires':
            require_once 'templates/commentaires.template.php';
            break;
        default :
            die('template inconnu');
    }
    
?>