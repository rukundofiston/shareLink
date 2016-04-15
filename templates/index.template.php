<?php
    defined('__SHARELINK__') or die('Acces interdit');
    
    $fichierVue = 'views/'.$page['view'];
    if(!file_exists($fichierVue)){
        $fichierVue = 'views/index.view.php';
    }
    if(isset($_SESSION['utilisateur'])) $disp="";
    else $disp="none";
    ?>

<html>
    <head>
        <title>
            SHARELINK
        </title>
        <link rel="stylesheet" type="text/css" href="./styles/sharelink.css" media="all">
        <link rel="stylesheet" href="./styles/jquery-ui.custom.css" />
        <script type="text/javascript" src="javascript/jquery.min.js"></script>
        <script type="text/javascript" src="javascript/principes.js"></script>
        <script type="text/javascript" src="javascript/jquery-ui.custom.js"></script>
		<script type="text/javascript" src="javascript/jquery.bgiframe-2.1.2.js"></script>
        <script type="text/javascript" src="javascript/monscript.js"></script>
        <?php InsererStyles($page); ?>
        <?php InsererScripts($page); ?>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <!--Inclusion du MENU de navigation-->
        <?php require 'views/modules/menu.php'; ?>
<!--ENTETE DU SITE-->
        <div id="entete">
            <div class="base960">
                <div id="principes">
                    <div id="principes_haut">
                        <div class="principe" id="principe1">
                            "Un site sans lien c'est comme une étoile sans firmament."
                        </div>
                        <div class="principe" id="principe2" style="display:none;">
                            "On ne peut être le meilleur si on est seul."
                        </div>
                        <div class="principe" id="principe3" style="display:none;">
                            "ShareLink, parce que votre avis est important"
                        </div>
                    </div>
                    <div id="principes_bas">
                        <ul>
                            <li class="selectionne">Découvrir</li>
                            <li>Partager</li>
                            <li>Évaluer</li>
                        </ul>
                    </div>
                </div>
                <div id="entete_droite">
                    <?php require $fichierVue;?>
                </div>
                <div id="piedsEntete">
                    
                </div>
            </div>
            
        </div>
        <!--Les 3 meilleurs liens qui seront affiché la page d'acceuil -->
        <div id="meilleurs">
            <div class="base960">
                <div> </div>
                <ul>
                    <?php $page['data'] = Liens_Meilleurs(3); ?>
                    <?php foreach ($page['data'] as $value): ?>
                    <a href="index.php?controller=liens&action=consulterlien&id=<?php echo $value['id']; ?>" target="_blank" style="color:white; text-decoration:none;">
                        <li>
                            <div class="lien">
                                <div class="date">
                                    <span class="jour"> <?php echo date('d', strtotime($value['date'])); ?> </span>
                                    <span class="mois"> <?php echo strtoupper(date('M', strtotime($value['date']))); ?> </span>
                                    <span class="annee"> <?php echo date('Y', strtotime($value['date'])); ?> </span>
                                </div>
                                <div class="titre"> <?php echo $value['titre']; ?> </div>
                                <div class="ajoute_par"> <?php echo $value['identifiant']; ?> </div>
                                <div class="description"> <?php echo $value['description']; ?> </div>
                            </div>
                        </li>
                    </a>
                    <?php endforeach; ?>
                    
                </ul>
            </div>
            
        </div>
        <!-- Les articles de la page d'aceuil -->
        <div id="editorial">
            <div class="base960">
                <div class="article">
                    <h2>Qui sommes nous ?</h2>
                    <p class="auteur"><span>Article écrit par Mohamed Aamer</span></p>
                    <p><span class="renforce">Sharelink</span> est une communauté d'internautes visant à
                    partager les liens tout en permettant l'évaluation et les commentaires.
                    La plateforme <span class="renforce">ShareLink</span> a été créée en 2013 dans le
                    cadre d'un projet du Module Client Serveur TP à la Faculté des Sciences et Théchniques.
                    <span class="renforce">ShareLink</span> s'enrichit
                    jour apèrs jour de nouvelles références.<br/>
                    L'équipe des bénévoles de <span class="renforce">ShareLink</span> travaille pour
                    améliorer continuellement <span class="important">l'ergonomie, la sécurité et la qualité</span>
                    de la plateforme.
                    Le but à terme étant d'arriver à l'échelle d'un réseau social complet dédié à
                    l'<span class="important">échange de liens</span>.
                    </p>
                </div>
                <div class="commentaires">
                    <h2>Derniers commentaires</h2>
                    <ul>
                    <?php $page['data'] = Commentaires_Derniers(3); ?>
                    <?php foreach ($page['data'] as $value): ?>
                        <li class="commentaire">
                                <p class="site"><?php echo $value['titre']; ?><span class="date"><?php echo $value['date'];?></span></p>
                                <p class="texte"> <?php echo $value['commentaire']; ?></p>
                                <p class="auteur"><?php echo $value['identifiant']; ?></p>
                        </li>
                    <?php endforeach;?>
                    </ul>
                    <button id="ajouter" style="display:<?php echo $disp?>">Ajouter un Commentaire</button>
                    <button id="listersTous"><a href="index.php?controller=liens&action=listerCommentaires">Tous les commentaire</a></button>
                </div>
                <div id="AjouterCommentaire" style="display:none">
                    <form id="form" action="" method="POST">
                        <p><label for="titre">Titre</label><br/>
                            <input id="titre" name="titre" title="Saisissez le titre"/>
                        </p>
                        <p><label for="commentaire">Commentaire</label>
                            <textarea name="commentaire" rows="5" cols="30" name="commentaire"></textarea> 
                        </p>
                        <p><input type="reset" value="Annuler" id="Annuler">
                            <input type="submit" value="Enregistre">
                        </p>
                    </form>
                </div>
                <div id="piedsEdito">
                </div>
            </div>
        </div>
        <div id="pieds">
            (c) Sharelink 2012
        </div>
		
		<?php require 'views/login.view.php'; ?>
		<?php require 'views/inscription.view.php'; ?>
    </body>
</html>