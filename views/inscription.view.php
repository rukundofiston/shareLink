<?php
    defined('__SHARELINK__') or die('Acces interdit');
?>

		<script>
$(function() {
    $( "#dialog-form1" ).dialog({
      autoOpen: false,
      height: 550,
      width: 300,
      modal: true
    });
 
    $( "#create-user1" ).click(function() {
        $( "#dialog-form1" ).dialog( "open" );
		$("#addUser").attr("action","index.php?controller=utilisateurs&action=ajouterutilisateur");
      });
    $("#addUser").submit(function(){
      var userName=$("#login").val();
      var motDepasse=$("#motDepasse").val();
          if ($("#nom").val()==""){
              $("#nom").addClass("error");
              return false;
          }
          if ($("#prenom").val()==""){
              $("#prenom").addClass("error");
              return false;
          }
          if ($("#email").val()==""){
              $("#email").addClass("error");
              return false;
          }
          if ($("#identifiant").val()==""){
              $("#identifiant").addClass("error");
              return false;
          }
          if ($("#motdepasse").val()==""){
              $("#motdepasse").addClass("error");
              return false;
          }
    });
  });
  </script>
  
<div id="dialog-form1" title="Ajouter un utilisateur" style="display: none;"> 
  <p id="form_erreur"><?php echo $page['message']; ?></p>
    <form name="addUser" id="addUser" action="" method="POST">
        <dl>
            <dt><label for="nom">Nom :</label></dt>
            <dd><input name="nom" id="nom" type="text" /></dd>
			<dt><label for="prenom">Pr&eacute;nom : </label></dt>
            <dd><input name="prenom" id="prenom" type="text" /></dd>
            <dt><label for="email">Email :</label></dt>
            <dd><input name="email" id="email" type="text"/></dd>
        </dl>
		<dl>
            <dt><label for="identifiant">Identifiant : </label></dt>
            <dd><input name="identifiant" id="identifiant" type="text"/></dd>
            <dt><label for="motdepasse">Mot de passe : </label></dt>
            <dd><input name="motdepasse" id="motdepasse" type="password"/></dd>
            <dt><label for="motdepassecf">Confirmer mot de passe : </label></dt>
            <dd><input name="motdepassecf" id="motdepassecf" type="password"/></dd></br>
            <dd><input type="submit" id="inscription" value="Enregistrer"/></dd>
        </dl>
    </form>
</div>