<?php
    defined('__SHARELINK__') or die('Acces interdit');
?>

<?php

if(!file_exists('include/config.ini')){
    die('Erreur Config.ini');
}
$accesBD = parse_ini_file(('include/config.ini'));

if(!$accesBD){
    die('Erreur : Acces BD Echoué');
}

try{
    $db = new PDO('mysql:host='.$accesBD['serveur'].';dbname='.$accesBD['base'], $accesBD['identifiant'], 
            $accesBD['motDePasse']);
}catch(PDOException $err){
    die('Erreur connexion BD');
}

function DBErreur($message,&$requete=null){
    $trace = debug_backtrace();
    ?>
    <p>DATA Erreur <?php echo $message;?></p>
    <p>Fonction : <?php echo $trace[1]['function'];?></p>
    <p>Ligne : <?php echo $trace[0]['line'];?></p>
    <?php
    if(!is_null($requete)){
        print_r($requete->errorInfo());
    }
    die();
}

function Utilisateurs_Lister(){
    global $db;
    $sql = "SELECT id,identifiant,nom,prenom,email FROM utilisateurs ORDER BY nom, prenom";
    $requete = $db->prepare($sql);
    if(!$requete->execute()){
        DBErreur('Erreur',$requete);
    }
    $utilisateurs = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $utilisateurs;
}

function Utilisateurs_Ajouter($identifiant,$nom,$prenom,$email,$motdepasse){
    global $db;
    if(($identifiant=='') || ($email=='') || ($motdepasse=='')){
        DBErreur('Parametre incorrect');
    }
    $sql = "INSERT INTO utilisateurs (identifiant,nom,prenom,email,motdepasse) VALUES ".
    "(:identifiant,:nom,:prenom,:email,:motdepasse)";
    $requete = $db->prepare($sql);
    $requete->bindValue(':identifiant',$identifiant);
    $requete->bindValue(':nom',$nom);
    $requete->bindValue(':prenom',$prenom);
    $requete->bindValue(':email',$email);
    $requete->bindValue(':motdepasse',md5($motdepasse));
    if(!$requete->execute()){
        DBErreur('Erreur',$requete);
    }
    Rediriger('./index.php');
    return $db->lastInsertId();
}

function Utilisateurs_Existe($identifiant, $email){
    global $db;
    
    if(($identifiant=='') || ($email=='')){
        DBErreur('Identifiant ou email incorrect');
    }
    $sql = "SELECT identifiant, email FROM utilisateurs WHERE identifiant = :identifiant OR email = :email";
    $requete = $db->prepare($sql);
    $requete->bindValue(':identifiant', $identifiant);
    $requete->bindValue(':email', $email);
    if(!$requete->execute()){
        DBErreur('Erreur', $requete);
    }
    $result = $requete->fetchall(PDO::FETCH_ASSOC);
    foreach($result as $ligne){
        if(ReqParam($ligne, 'identifiant') || ReqParam($ligne, 'email')){
            return TRUE;
        }
    }
    return FALSE;
}

function Utilisateurs_Authentifier($identifiant, $motdepasse){
    global $db;
    
    if(($identifiant=='') || ($motdepasse=='')){
        DBErreur('identifiant ou mot de passe incorrect');
    }
    $sql="SELECT id, identifiant, motdepasse FROM Utilisateurs WHERE identifiant = :identifiant AND motdepasse = :motdepasse";
    $requete = $db->prepare($sql);
    $requete->bindValue('identifiant', $identifiant);
    $requete->bindValue('motdepasse', md5($motdepasse));
    if(!$requete->execute()){
        DBErreur('Erreur', $requete);
    }
    if($requete->rowCount() != 0){
        return $requete->fetchColumn(0);
    }
    return FALSE;
}

function Utilisateurs_Details($id){
    global $db;
    
    $sql="SELECT * FROM Utilisateurs WHERE id=:id";
    $requete = $db->prepare($sql);
    $requete->bindValue('id', $id);
    if(!$requete->execute()){
        DBErreur('Erreur', $requete);
    }
    return $requete->fetchAll(PDO::FETCH_ASSOC);
}

function Utilisateurs_Compter(){
    global $db;
    
    $sql="SELECT * FROM Utilisateurs";
    $requete = $db->prepare($sql);
    if(!$requete->execute()){
        DBErreur('Erreur', $requete);
    }
    return $requete->rowCount();
}

function Liens_Ajouter($titre,$utilisateur,$description,$url){
    global $db;
    
    if($titre=='' || $utilisateur =='' || $description=='' || $url==''){
        DBErreur('Veuillez remplir tous les champs');
    }
    $sql = "SELECT * FROM Liens WHERE titre=:titre OR url=:url";
    $requete = $db->prepare($sql);
    $requete->bindValue('titre', $titre);
    $requete->bindValue('url', $url);
    if(!$requete->execute()){
        DBErreur('Erreur', $requete);
    }
    if($requete->rowCount() == 0){
        $sql="INSERT INTO Liens (titre,utilisateur,description,date,visite,url) VALUES (:titre,:utilisateur,:description,:date,0,:url)";
        $requete = $db->prepare($sql);
        $requete->bindValue('titre', $titre);
        $requete->bindValue('utilisateur', $utilisateur);
        $requete->bindValue('description', $description);
        $requete->bindValue('date', date('Y-m-d H:i:s'));
        $requete->bindValue('url', $url);
        if(!$requete->execute()){
            DBErreur('Erreur', $requete);
        }
        return TRUE;
    }
    else{
        foreach($requete as $ligne){
            if(ReqParam($ligne, 'url')){
                return 'Cette URL existe d&eacute;j&agrave;.';
            }
        }
    }
}

function Liens_Modifier($id,$titre,$description,$url){
    global $db;
    
    if($titre=='' || $description=='' || $url==''){
        DBErreur('Veuillez remplir tous les champs');
    }
    $sql = "SELECT * FROM Liens WHERE (titre=:titre OR url=:url) AND id<>:id";
    $requete = $db->prepare($sql);
    $requete->bindValue('titre', $titre);
    $requete->bindValue('url', $url);
    $requete->bindValue('id',$id);
    if(!$requete->execute()){
        DBErreur('Erreur', $requete);
    }
    if($requete->rowCount() == 0){
        $sql="UPDATE Liens SET titre=:titre,description=:description,url=:url WHERE id=:id";
        $requete = $db->prepare($sql);
        $requete->bindValue('titre', $titre);
        $requete->bindValue('description', $description);
        $requete->bindValue('url', $url);
        $requete->bindValue('id',$id);
        if(!$requete->execute()){
            DBErreur('Erreur', $requete);
        }
        return TRUE;
    }
    else{
        foreach($requete as $ligne){
            if(ReqParam($ligne, 'url')){
                return 'Cette URL existe d&eacute;j&agrave;.';
            }
        }
    }
}

function Liens_Supprimer($id){
    global $db;
    
    $sql="DELETE FROM Commentaires WHERE lien = :id";
    $requete = $db->prepare($sql);
    $requete->bindValue('id',$id);
    if(!$requete->execute()){
        DBErreur('Erreur', $requete);
    }
    $sql="DELETE FROM Liens WHERE id=:id";
    $requete = $db->prepare($sql);
    $requete->bindValue('id',$id);
    if(!$requete->execute()){
        DBErreur('Erreur', $requete);
    }
    return TRUE;
}

function Liens_Visiter($id){
    global $db;
    
    $sql = "UPDATE Liens SET visite=visite+1 WHERE id=:id";
    $requete = $db->prepare($sql);
    $requete->bindValue('id',$id);
    if(!$requete->execute()){
        DBErreur('Erreur', $requete);
    }
}
function Liens_Details($id){
    global $db;
    
    $sql="SELECT * FROM Liens WHERE id=:id";
    $requete = $db->prepare($sql);
    $requete->bindValue('id',$id);
    if(!$requete->execute()){
        DBErreur('Erreur', $requete);
    }
    if($requete->rowCount()==0){
        return FALSE;
    }
    $detail[] = $requete->fetch(PDO::FETCH_ASSOC);
    
    $sql="SELECT titre, commentaire, date, identifiant, nom, prenom ".
            "FROM Commentaires INNER JOIN Utilisateurs ON utilisateur = Utilisateurs.id ".
            "WHERE lien = :id ".
            "ORDER BY date";
    $requete = $db->prepare($sql);
    $requete->bindValue('id',$id);
    if(!$requete->execute()){
        DBErreur('Erreur', $requete);
    }
    $detail[] = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $detail;
}

function Liens_Meilleurs($n){
    global $db;
    
    if($n<=0)
        return FALSE;
    $sql="SELECT Liens.id id, titre, description, date, url, identifiant, nom, prenom ".
        "FROM Liens INNER JOIN Utilisateurs ON utilisateur=Utilisateurs.id ".
        "ORDER BY visite DESC, Date DESC ".
        "LIMIT :n";
    $requete = $db->prepare($sql);
    $requete->bindValue('n', $n, PDO::PARAM_INT);
    if(!$requete->execute()){
        DBErreur('Erreur', $requete);
    }
    return $requete->fetchAll(PDO::FETCH_ASSOC);
}

function Liens_Compter(){
    global $db;
    
    $sql="SELECT * FROM Liens";
    $requete = $db->prepare($sql);
    if(!$requete->execute()){
        DBErreur('Erreur', $requete);
    }
    return $requete->rowCount();
}

function Liens_Lister($critere='date',$ordre='desc'){
    global $db;
    
    $sql="SELECT Liens.id, Liens.titre, description, liens.date, visite, Liens.utilisateur utilisateur, identifiant, COUNT(Lien) Commentaires ".
        "FROM (Liens LEFT JOIN Commentaires ON Liens.id = lien) INNER JOIN ".
            "Utilisateurs ON Utilisateurs.id=Liens.utilisateur ".
        "GROUP BY liens.id ";
        
    switch ($critere){
        case 'titre' :
            $sql= $sql ."ORDER BY Liens.titre ";
            break;
        case 'date' :
            $sql= $sql ."ORDER BY Liens.date ";
            break;
        case 'utilisateur' :
            $sql= $sql ."ORDER BY identifiant ";
            break;
        case 'visites' :
            $sql= $sql ."ORDER BY visite ";
            break;
        case 'commentaires' :
            $sql= $sql ."ORDER BY COUNT(Lien) ";
            break;
        default :
            die('critere inconnu');
    }
    switch ($ordre){
        case 'ascendant' :
        case 'ASC' :
        case 'asc' :
            $sql= $sql ."ASC ";
            break;
        case 'descendant' :
        case 'DESC' :
        case 'desc' :
            $sql= $sql ."DESC ";
            break;
        default :
            die('ordre inconnu');
    }
    
    $requete = $db->prepare($sql);
    if(!$requete->execute()){
        DBErreur('Erreur', $requete);
    }
    
    return $requete->fetchAll(PDO::FETCH_ASSOC);
}

function Commentaires_Ajouter($utilisateur,$titre,$commentaire){
    global $db;
    
    if($commentaire == '' ||$titre=='')
        return FALSE;
    $sql="INSERT INTO commentaires (utilisateur,titre,commentaire,date) VALUES (:utilisateur,:titre,:commentaire,:date)";
    $requete = $db->prepare($sql);
    $requete->bindValue('utilisateur', $utilisateur);
    $requete->bindParam('titre', $titre, PDO::PARAM_STR);
    $requete->bindValue('commentaire', $commentaire);
    $requete->bindValue('date', date('Y-m-d H:i:s'));
    
    if(!$requete->execute()){
        DBErreur('Erreur', $requete);
    }
    return TRUE;
}

function Commentaires_Supprimer($lien,$utilisateur,$date){
    global $db;
    
    $sql="DELETE FROM commentaires WHERE utilisateur=:utilisateur AND date=:date";
    $requete=$db->prepare($sql);
    $requete->bindValue('utilisateur', $utilisateur);
    $requete->bindValue('date', $date);
    if(!$requete->execute()){
        DBErreur('Erreur', $requete);
    }
    return TRUE;
}

function Commentaires_Lister(){
    global $db;
    
    $sql = "SELECT * FROM Commentaires";
    $requete = $db->prepare($sql);
    if(!$requete->execute()){
        DBErreur('Erreur', $requete);
    }
    return $requete->fetchAll(PDO::FETCH_ASSOC);
}
function Commentaires_Compter(){
    global $db;
    
    $sql = "SELECT * FROM Commentaires";
    $requete = $db->prepare($sql);
    if(!$requete->execute()){
        DBErreur('Erreur', $requete);
    }
    return $requete->RowCount();
}

function Commentaires_Derniers($n){
    global $db;
    
    $sql="SELECT identifiant,titre,commentaire,date FROM commentaires,utilisateurs WHERE commentaires.utilisateur=utilisateurs.id 
    ORDER BY date DESC LIMIT :n";    
    $requete = $db->prepare($sql);
    $requete->bindValue('n', $n, PDO::PARAM_INT);
    if(!$requete->execute()){
        DBErreur('Erreur', $requete);
    }
    return $requete->fetchAll(PDO::FETCH_ASSOC);
}

function AjouterCommentaire($utilisateur,$titre,$commentaire,$date,$identifiant){
    global $db;
    if($titre=='' || $utilisateur =='' || $commentaire==''){
        DBErreur('Veuillez remplir tous les champs');
    }
    $sql="INSERT INTO commentaires (utilisateur,titre,commentaire,date,lien) VALUES (:utilisateur,:titre,:commentaire,:date,:identifiant)";
    $requete = $db->prepare($sql);
    $requete->bindValue('utilisateur', $utilisateur);
    $requete->bindValue('titre', $titre);
    $requete->bindValue('commentaire', $commentaire);
    $requete->bindValue('date', $date);
    $requete->bindValue('identifiant', $identifiant);   
    if(!$requete->execute()){
        DBErreur('Erreur', $requete);
    }
    Rediriger('./index.php');
}
    ?>
