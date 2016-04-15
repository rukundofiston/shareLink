
$(document).ready(function(){
        var form = $(document.inscription);
        var message = $('#form_erreur');
        form.submit(function(){
            var nom = $('#nom');
            var texte = nom.val();
            if(texte == ''){
                message.html('Nom incorrect');
                nom.addClass('form_erreur');
                nom.focus();    
                return false;
            }
            nom.removeClass('form_erreur');
            var prenom = $('#prenom');
            if($.trim(prenom.val()) == ''){
                message.html('Prenom incorrect');
                prenom.addClass('form_erreur');
                prenom.focus();
                return false;
            }
            prenom.removeClass('form_erreur');
            var email = $('#email');
            if($.trim(email.val()) == ''){
                message.html('Email incorrect');
                email.addClass('form_erreur');
                email.focus();
                return false;
            }
            var contenu = email.val();
            var taille = contenu.length;
            var test_aro = 0;
            var test_pos_aro = 0;
            var test_point = 0;
            var i;
            for(i=0;i<taille;i++){
                if(contenu[i]=='@'){
                    test_aro = 1;
                    if(i>=2)
                        test_pos_aro = i;
                }
                if(contenu[i]=='.'){
                    if(i>test_pos_aro+2 && taille>i+2)
                        test_point = 1;
                }
            }
            if(!(test_aro && test_point && test_pos_aro)){
                message.html('Email incorrect');
                email.addClass('form_erreur');
                email.focus();
                return false;
            }
            email.removeClass('form_erreur');
            
            var identifiant = $('#identifiant');
            if($.trim(identifiant.val()) == ''){
                message.html('Indentifiant incorrect');
                identifiant.addClass('form_erreur');
                identifiant.focus();
                return false;
            }
            identifiant.removeClass('form_erreur');
            var motDePasse = $('#motdepasse');
            if($.trim(motDePasse.val()) == ''){
                message.html('Mot de passe incorrect');
                motDePasse.addClass('form_erreur');
                motDePasse.focus();
                return false;
            }
            motDePasse.removeClass('form_erreur');
            var motDePassecf = $('#motdepassecf');
            if($.trim(motDePassecf.val()) == ''){
                message.html('Confirmer votre mot passe');
                motDePassecf.addClass('form_erreur');
                motDePassecf.focus();
                return false;
            }
            motDePassecf.removeClass('form_erreur');
            if($.trim(motDePassecf.val()) != $.trim(motDePasse.val())){
                message.html('Confirmation incorrecte');
                return false;
            }
            
        });
    }
);
