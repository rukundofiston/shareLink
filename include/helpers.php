<?php
    defined('__SHARELINK__') or die('Acces interdit');

    function ReqParam(&$source,$nom,$default=''){
        if(isset($source[$nom])){
            return $source[$nom];
        }
        return $default;
    }
    
    function Rediriger($url){
            header('Location:'.$url);
    }

    function InsererStyles(&$page){
        foreach($page['styles'] as $S):
        ?>
        <link rel="stylesheet" type="text/css" href="styles/<?php echo $S;?>" />
        <?php
        endforeach;
    }
    
    function MenuConnexion(){
        if(isset($_SESSION['utilisateurId'])):
            ?>
            <a href="index.php?controller=utilisateurs&action=sedeconnecter">Se Déconnecter</a>
            <?php
        else:
            ?>
            <a  id="seconnecter" >Se Connecter</a>			
            <?php
        endif;
    }
    
    function SessionAnonyme(){
        if(isset($_SESSION['utilisateurId'])){
            return FALSE;
        }
        return TRUE;
    }
    
    function Proprietaire(&$lien){
        if (SessionAnonyme()==FALSE && $_SESSION['utilisateurId']==$lien){
            return TRUE;
        }
        return FALSE;
    }
    
    function ListeLiens_Lien($ordre){
        global $page;
        
        if($page['order']==$ordre){
            if($page['order_dir']=='ASC')
                $dir='DESC';
            else
                $dir='ASC';
        }
        else
            $dir=$page['order_dir'];
        return "index.php?controller=liens&action=listerliens&order=$ordre&order_dir=$dir";
    }
    
    function ListeLiens_ImageTri($ordre){
        global $page;
        
        if($page['order']==$ordre){
            if($page['order_dir']=='ASC'): ?>
                <img src="images/dir_asc.png" />
                <?php
            else :?>
                <img src="images/dir_desc.png" />
                <?php
            endif;
        }
    }
    
    function InsererScripts(&$page){
        foreach($page['scripts'] as $S):
        ?>
        <script type="text/javascript" src="javascript/<?php echo $S ?>"></script>
        <?php
        endforeach;
    }
        ?>