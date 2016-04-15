$(document).ready(function(){
        $("#AjouterCommentaire").dialog({
            minHeight : 300,
            minWidth : 450,
            modal : true,
            autoOpen : false
        });
		  $(function() {
        $("#dialog-form" ).dialog({
        autoOpen: false,
        height: 300,
        width: 300,
        modal: true
      });
 
      $("#seconnecter" ).click(function() {
        $("#dialog-form" ).dialog("open" );
        $("#loginForm").attr("action","index.php?controller=utilisateurs&action=seconnecter");
      });
      $("#loginForm").submit(function(){
          var userName=$("#login").val();
          var motDepasse=$("#motDepasse").val();
          if (userName==""){
              $("#login").addClass("error");
              return false;
          }
          if(motDepasse==""){
              $("#motDepasse").addClass("error");
              return false;
          };
      });
  });

        $(function() {
            $("#ajouter")
            .button()
            .click(function( event ) {
            $("#AjouterCommentaire").dialog();
            $("#form").attr("action", "index.php?controller=liens&action=ajoutercommentaire")
            $("#AjouterCommentaire").dialog("open");
            });
            $("input[type=submit],button,input[type=reset]").button();
            $("#listersTous").button();
        });

    function verifier(){
      var userName=$("#login").val();
      var motdepasse=$("#motdepasse").val();
      if (userName==''){ alert("champ vide");}
    }
});


