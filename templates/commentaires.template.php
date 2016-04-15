<?php
    defined('__SHARELINK__') or die('Acces interdit');
    
    $fichierVue = 'views/'.$page['view'];
    if(!file_exists($fichierVue)){
        $fichierVue = 'views/index.view.php';
    }
    if(isset($_SESSION['utilisateur'])) $disp="";
    else $disp="none";
    ?>

<html>
    <head>
        <title>
            SHARELINK
        </title>
        <link rel="stylesheet" type="text/css" href="./styles/sharelink.css" media="all">
        <link rel="stylesheet" href="styles/jquery-ui.custom.css" />
        <script type="text/javascript" src="javascript/jquery.min.js"></script>
        <script type="text/javascript" src="javascript/principes.js"></script>
        <script type="text/javascript" src="javascript/jquery-ui.custom.js"></script>
        <script type="text/javascript" src="javascript/monscript.js"></script>
        <?php InsererStyles($page); ?>
        <?php InsererScripts($page); ?>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <!--Inclusion du MENU de navigation-->
        <?php require 'views/modules/menu.php'; ?>
    <!--ENTETE DU SITE-->
        <div id="editorial">
            <div class="base960">
                <h2>Derniers commentaires</h2>
                <div id="meilleurss">
                    <ul>
                    <?php 
                    $n=Commentaires_Compter();
                    $page['data'] = Commentaires_Derniers($n); ?>
                    <?php foreach ($page['data'] as $value): ?>
                        <li class="commentaire">
                                <p class="site"><?php echo $value['titre']; ?><span class="date"><?php echo $value['date'];?></span></p>
                                <p class="texte"> <?php echo $value['commentaire']; ?></p>
                                <p class="auteur"><?php echo $value['identifiant']; ?></p>
                        </li>
                    <?php endforeach;?>
                    <button id="ajouter" style="display:<?php echo $disp?>">Ajouter un Commentaire</button>
                    </ul>
                    
                <div id="AjouterCommentaire" style="display:none">
                    <form id="form" action="" method="POST">
                        <p><label for="titre">Titre</label><br/>
                            <input id="titre" name="titre" title="Saisissez le titre"/>
                        </p>
                        <p><label for="commentaire">Commentaire</label>
                            <textarea rows="5" cols="30" name="commentaire"></textarea> 
                        </p>
                        <p><input type="reset" value="Annuler" id="Annuler">
                            <input type="submit" value="Enregistre">
                        </p>
                    </form>
                </div>
            </div>
    </div>
    <div id="pieds2">
            (c) Sharelink 2012
        </div>
    </body>
    
</html>

