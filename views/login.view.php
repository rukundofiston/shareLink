<?php
    defined('__SHARELINK__') or die('Acces interdit');
?>
<div id="dialog-form" title="Se connecter" style="display: none;">
 <p id="form_erreur"><?php echo $page['message']; ?></p>
    <form name="loginForm" id="loginForm" action="" method="POST">
        <dl>
            <dt><label for="login">Login : </label></dt>
            <dd><input name="login" id="login" type="text" /></dd>
            <dt><label for="motDepasse">Mot de passe : </label></dt>
            <dd><input name="motDepasse" id="motDepasse" type="password"/></dd></br>
            <dd><input type="submit" value="Se Connecter"/></dd>
        </dl>
    </form>
</div>
