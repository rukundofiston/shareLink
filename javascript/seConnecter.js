/*window.onload = function(){
    document.login.onSubmit = function(){
        var message = document.getElementById("form_erreur");
        var texte;
        while(message.childNodes.length>0){
            message.removeChild(message.firstChild);
        }
        if(document.loginForm.login.value == ""){
            if(message.childNodes.length==0){
                texte = document.createTextNode('Login manquant');
                message.appendChild(texte);
            }
            return false;
        }
        if(document.loginForm.motdepasse.value == ""){
            if(message.childNodes.length==0){
                texte = document.createTextNode('Mot de passe manquant');
                message.appendChild(texte);
            }
            return false;
        }
        return true;
    }
}*/