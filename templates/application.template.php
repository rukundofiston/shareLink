<?php
    defined('__SHARELINK__') or die('Acces interdit');

    $fichierVue = 'views/'.$page['view'];
    if(!file_exists($fichierVue)){
        die('Vue inconnue');
    }
    
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
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <!--Inclusion du MENU de navigation-->
        <?php require 'views/modules/menu.php'; ?>
<!--ENTETE DU SITE-->
        <div id="entete">
            <div class="base960">
                <?php require $fichierVue; ?>
            </div>
            
        </div>
        
        <div id="pieds">
            (c) Sherlink 2012
        </div>
    </body>
</html>

