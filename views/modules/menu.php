<?php 
    defined('__SHARELINK__') or die('Acces interdit');
?>

        <div id ="navigation">
            <div class="base960">
                <h1> <a href="index.php"> <img src="./images/sharelink_logo.png" alt="SHERLINK"/> </a> </h1>
                <ul>
                    <li> <a href="index.php"> Accueil </a> </li>
                    <li> <a href="index.php?controller=liens&action=listerliens"> Les liens </a> </li>
                    <li> <?php MenuConnexion(); ?> </li>
                    <?php 
                        if(SessionAnonyme()==FALSE): 
                            ?><li> <a href="index.php?controller=liens&action=editerlien&id=0"> Ajouter Lien </a> </li>
                            <?php
                        endif;
                    ?>
                </ul>
            </div>
        </div>
        <div>
            
        </div>

