<?php
    defined('__SHARELINK__') or die('Acces interdit');
?>

    <div id="stats_haut">
        <div class="stat">
            <img src="images/decouvrir.png" alt="decouvrir"/><br/><?php echo Liens_Compter(); ?><br/>Liens
        </div>
        <div class="stat">
            <img src="images/partager.png" alt="partager"/><br/><?php echo Utilisateurs_Compter(); ?><br/>Utilisateurs
        </div>
        <div class="stat">
            <img src="images/evaluer.png" alt="evaluer"/><br/><?php echo Utilisateurs_Compter(); ?><br/>Utilisateurs
        </div>
    </div>
    <?php 
	if(!isset($_SESSION['utilisateurId'])): ?>
	
	<div id="stats_bas">
        <a id="create-user1"> 
            <div id="btn_inscrire">
                <img src="images/s_inscrire.png" alt="s_inscrire"/>
            </div>
        </a>
    </div>
<?php endif; ?>
</br>
</br>
</br>
<?php 
	if(isset($_SESSION['utilisateurId'])): ?>
    <center>
    <div>
        Bienvenue <b> <?php echo $_SESSION['utilisateur'][0]['nom']." ".$_SESSION['utilisateur'][0]['prenom'];?></b>
    </div>
    </center>
<?php endif; ?>