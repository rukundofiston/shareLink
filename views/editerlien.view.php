<?php
    defined('__SHARELINK__') or die('Acces interdit');
?>
<div id="editerLiens">
    <form method="POST" action="<?php echo $page['form']['action'];?>" name="form">
        <div id="formulaire">
            <h2><?php echo $page['texte'];?></h2>
            <p><?php echo $page['message'];?></p> 
                <dl>
                    <dt><label for="titre">Titre : </label></dt>
                    <dd><input name="titre" id="titre" type="text" value="<?php echo $page['form']['titre'];?>"></dd>
                    <dt><label for="url">URL : </label></dt>
                    <dd><input name="url" id="url" type="text"  value="<?php echo $page['form']['url'];?>"></dd>
                    <dt><label for="description">Description : </label></dt>
                    <dd><textarea name="description" id="description"><?php echo $page['form']['description'];?></textarea></dd>
                </dl>
        </div>
        <div id="commandes">
            <input type="hidden" name="id" value="<?php echo $page['form']['id'];?>" />
            <input type="reset" value="Effacer"/>
            <input type="submit" value="Enregistrer" />
        </div>
    </form>
</div>