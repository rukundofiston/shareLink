<?php
    defined('__SHARELINK__') or die('Acces interdit');
?>

<?php
    $actionParDefaut = 'index';
    function Executer($action){
        switch ($action){
            case 'index':
                IndexAction();
                break;
            case 'detaillien':
                DetailLienAction();
                break;
            case 'listerliens':
                ListerLiensAction();
                break;
            case 'editerlien':
                EditerLienAction();
                break;
            case 'supprimerlien':
                SupprimerLienAction();
                break;
            case 'consulterlien':
                ConsulterLienAction();
                break;
            case 'ajoutercommentaire':
                AjouterCommentaireAction();
                break;
            case 'supprimercommentaire':
                SupprimerCommentaireAction();
                break;
            case 'listerCommentaires':
                ListerCommentairesAction();
                break;
            default:
                die('Action inconnue');
        }
    }
    
    function IndexAction(){
        global $page;
       
        $page['template'] ='index';
        $page['view'] ='index.view.php';
        $page['styles'][] ='stats.css';
    }

    function DetailLienAction(){
        global $page;    
    }
    
    function ConsulterLienAction(){
        if(isset($_GET['id'])){
            Liens_Visiter($_GET['id']);
            $lien = Liens_Details($_GET['id']);
            if($lien!==FALSE)
                Rediriger($lien[0]['url']);
            else
                Rediriger ('index.php?controller=liens&action=listerliens');
        }
    }
    
    function ListerLiensAction(){
        global $page;
        
        $page['template'] = 'application';
        $page['view'] = 'listerliens.view.php';
        $page['styles'][] = 'application.css';
        $page['order'] = ReqParam($_GET, 'order');
        $page['order_dir'] = ReqParam($_GET, 'order_dir');
        if(in_array($page['order'], array('titre','utilisateur','date','visites'))==FALSE)
            $page['order']='date';
        if(in_array($page['order_dir'], Array('ASC','DESC'))==FALSE)
            $page['order_dir']='DESC';
        
        $page['data'] = Liens_Lister($page['order'], $page['order_dir']);
    }
    function EditerLienAction(){
        global $page;
        if(SessionAnonyme()==TRUE)
            Rediriger ('index.php?controller=liens&action=listerliens');
        $page['template'] = 'application';
        $page['view'] = 'editerlien.view.php';
        $page['styles'][] = 'application.css';
        if($_SERVER['REQUEST_METHOD']=='GET'){
            $idLien = ReqParam($_GET, 'id');
            if($idLien != 0){// Si Edition
                $lien = Liens_Details($idLien);
                if(Proprietaire($lien[0]['utilisateur'])==FALSE){
                    Rediriger ('index.php?controller=liens&action=listerliens');
                }
                $page['form']['action'] = "index.php?controller=liens&action=editerlien&id=$idLien";
                $page['texte'] = 'Edition';
                $page['form']['titre'] = $lien[0]['titre'];
                $page['form']['url'] = $lien[0]['url'];
                $page['form']['description'] = $lien[0]['description'];
                $page['form']['id'] = $idLien;
                return;
            }
            $page['form']['action'] = 'index.php?controller=liens&action=editerlien&id=0';
            $page['texte'] = 'Cr&eacute;ation';
            $page['form']['titre'] = '';
            $page['form']['url'] = '';
            $page['form']['description'] = '';
            $page['form']['id'] = 0;
            return;
        }

        if($_SERVER['REQUEST_METHOD']=='POST'){
            $page['form']['titre'] = ReqParam($_POST, 'titre');
            $page['form']['url'] = ReqParam($_POST, 'url');
            $page['form']['description'] = ReqParam($_POST, 'description');
            $page['form']['id'] = ReqParam($_POST, 'id');
            if($page['form']['id'] == 0){
                $page['texte'] = 'Cr&eacute;ation';
                $page['form']['action'] = 'index.php?controller=liens&action=editerlien&id=0';
            }
            else{
                $page['texte'] = 'Edition';
                $page['form']['action'] = "index.php?controller=liens&action=editerlien&id=".$page['form']['id'];
            }
            //VALIDITE FORMULAIRE
            if($page['form']['titre']==''){
                $page['message'] = 'Titre Incorrecte';
                return;
            }
            if(filter_var($page['form']['url'], FILTER_VALIDATE_URL)==FALSE){
                $page['message'] = 'url incorrecte';
                return;
            }
            if($page['form']['description']==''){
                $page['message'] = 'description incorrecte';
                return;
            }
            if($page['form']['id'] != 0){//Si Edition
                $page['message'] = Liens_Modifier($page['form']['id'], $page['form']['titre'], $page['form']['description'], $page['form']['url']);
                if($page['message']!=TRUE)//SI MODIFICATION ECHOUEES MESSAGE = MESSAGE D'ERREUR
                    return;
                $page['message'] = 'Le lien a &eacute;t&eacute; modifi&eacute;.';
            }
            else{
                $page['message'] = Liens_Ajouter($page['form']['titre'], $_SESSION['utilisateurId'], $page['form']['description'], $page['form']['url']);
                if($page['message']!=TRUE)//SI AJOUT ECHOUE SINON MESSAGE = MESSAGE D'ERREUR
                    return;
                $page['message'] = 'Le lien a &eacute;t&eacute; ajout&eacute;.';
            }
            Rediriger('index.php?controller=liens&action=listerliens');
        }
    }
    function AjouterCommentaireAction(){
        global $page;

        //echo "commentaire à ajouter";
        $page['scripts'][] = 'monscript.js';
        $page['template'] = 'index';
        $page['view'] = 'index.view.php';
        $page['view'] = 'AjouterCommentaire.view.php';
        $page['form2']['titre'] = ReqParam($_POST,'titre');
        $page['form2']['commentaire'] = ReqParam($_POST,'commentaire');
        if($_SERVER['REQUEST_METHOD']=='POST'){
            if(trim($page['form2']['titre'])==''){
                $page['message'] = 'Nom manquant';
                return;
            }
            if(trim($page['form2']['commentaire'])==''){
                $page['message'] = 'Champ de commentaire vide';
                return;
            }
        if(!$_SESSION['utilisateurId']){
            $utilisateur=0;
        }
        else $utilisateur=$_SESSION['utilisateurId'];  

        Commentaires_Ajouter($utilisateur,$page['form2']['titre'],$page['form2']['commentaire']);
        //Rediriger('index.php');
        return;
        }
    }

    function ListerCommentairesAction(){ 
        global $page;
        $page['view'] = 'listecommentaire.view.php';
        $page['template'] = 'commentaires';     
    }
    
    function SupprimerCommentaireAction(){
        global $page;
        
    }
?>