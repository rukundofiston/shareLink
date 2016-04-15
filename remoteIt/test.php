<?php
define('__SHARELINK__', '');
require_once 'include/data.php';
require_once 'include/helpers.php';
$user = Utilisateurs_Lister();
    ?>
    <pre>
        <?php //print_r($user); ?>
    </pre>
<?php 
    $exist = Utilisateurs_Authentifier('wandjiew', 'willy');
    if($exist == TRUE){
        echo 'vrai';
    }
    if($exist == FALSE){
        echo 'faux';
    }
    print_r(Liens_Lister());
    ?>
