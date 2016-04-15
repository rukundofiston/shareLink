<?php
    defined('__SHARELINK__') or die('Acces interdit');
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
<div class="commentaires">
                    <h2>Derniers commentaires</h2>
                    <ul>

                    <?php 
                    $nbre=$nbre=Commentaires_Compter();
                    $page['data'] = Commentaires_Derniers($nbre); ?>
                    <?php foreach ($page['data'] as $value): ?>
                        <li class="commentaire">
                                <p class="site"><?php echo $value['titre']; ?><span class="date"><?php echo $value['date'];?></span></p>
                                <p class="texte"> <?php echo $value['commentaire']; ?></p>
                                <p class="auteur"><?php echo $value['identifiant']; ?></p>
                        </li>
                    <?php endforeach;?>
                    </ul>
                    <button id="ajouter" style="display:<?php echo $disp?>">Ajouter un Commentaire</button>
                    <button id="tous"><a href="index.php?controller=liens&action=listerCommentaires">Tous les commentaire</a></button>
</div>
</body>
</html>