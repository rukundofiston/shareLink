<?php
    defined('__SHARELINK__') or die('Acces interdit');
?>

<?php

    $actionParDefaut = '';
    function Executer($action){
        switch ($action){
            case 'seconnecter':
                SeConnecterAction();
                break;
            case 'sedeconnecter':
                SeDeconnecterAction();
                break;
            case 'ajouterutilisateur':
                AjouterUtilisateurAction();
                break;
            default:
                die('Action inconnue');
        }
    }
    
    function SeConnecterAction(){
        global $page;
        
		if(isset($_SESSION['utilisateurId'])){
          Rediriger('./index.php');
            return;
        }
        $page['template']='index';
        $page['view'] = 'login.view.php';
        $page['scripts'][] = 'seConnecter.js'; 
        $page['form']['login'] = ReqParam($_POST, 'login');
        $page['form']['motDepasse'] = ReqParam($_POST, 'motDepasse');
        if($_SERVER['REQUEST_METHOD']=='POST'){
            if(trim($page['form']['login'])==''){
                $page['message'] = 'Login manquant';
                return;
            }
            if(trim($page['form']['motDepasse'])==''){
                $page['message'] = 'mot de passe manquant';
                return;
            }

            $idUtilisateur = Utilisateurs_Authentifier($page['form']['login'], $page['form']['motDepasse']);
            if($idUtilisateur === FALSE){
                $page['message'] = 'login/motDepasse incorrecte';
                Rediriger('./index.php');
                return;
            }
            //$page['message'] = 'Authentification OK';
            $_SESSION['utilisateurId'] = $idUtilisateur;
            Rediriger('./index.php');
            
        }
    }
    function SeDeconnecterAction(){
        global $page;
        
        if(!isset($_SESSION['utilisateurId']))
            return;
        session_destroy();
        Rediriger('./index.php');
    }
    function AjouterUtilisateurAction(){
        global $page;
        
        $page['scripts'][] = 'ajouterUtilisateur.js';
        $page['template'] = 'index';
        $page['view'] = 'inscription.view.php';
        $page['form']['nom'] = ReqParam($_POST, 'nom');
        $page['form']['prenom'] = ReqParam($_POST, 'prenom');
        $page['form']['email'] = ReqParam($_POST, 'email');
        $page['form']['identifiant'] = ReqParam($_POST, 'identifiant');
        $page['form']['motdepasse'] = ReqParam($_POST, 'motdepasse');
        $page['form']['motdepassecf'] = ReqParam($_POST, 'motdepassecf');
        if($_SERVER['REQUEST_METHOD']=='POST'){
            if(trim($page['form']['nom'])==''){
                $page['message'] = 'Nom manquant';
                return;
            }
            if(trim($page['form']['prenom'])==''){
                $page['message'] = 'Pr&eacutenom manquant';
                return;
            }
            if(trim($page['form']['email'])==''){
                $page['message'] = 'Email manquant';
                return;
            }
            if(trim($page['form']['identifiant'])==''){
                $page['message'] = 'Identifiant manquant';
                return;
            }
            if(trim($page['form']['motdepasse'])==''){
                $page['message'] = 'Mot de passe manquant';
                return;
            }
            if(trim($page['form']['motdepassecf'])==''){
                $page['message'] = 'confirmer le mot de passe';
                return;
            }
            if(filter_var($page['form']['email'],FILTER_VALIDATE_EMAIL)===FALSE){
                $page['message']= 'Email invalide';
                return;
            }
            if(Utilisateurs_Existe($page['form']['identifiant'], $page['form']['email'])==TRUE){
                $page['message']= 'identifiant ou email existe d&eacute;j&agrave;';
            }
            if(strcmp($page['form']['motdepasse'], $page['form']['motdepassecf'])!=0){
                $page['message']= 'confirmation de mot de passe incorrecte';
                return;
            }
            Utilisateurs_Ajouter($page['form']['identifiant'], $page['form']['nom'], $page['form']['prenom'], $page['form']['email'], $page['form']['motdepasse']);
            //BOUCLE POUR VIDER LE FORMULAIRE
            foreach ($page['form'] as &$value) {
                $value='';
            }
            unset($value);
            $page['message']='Utilisateur Enregistr&eacute;';
            return;
        }
        
    }
?>