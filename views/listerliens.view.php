<?php
    defined('__SHARELINK__') or die('Acces interdit');
?>

<table id="listeLiens">
    <thead>
        <tr>
            <th class="titre"> 
                <a href="<?php echo ListeLiens_Lien('titre');?>"> Titre </a>
                <?php ListeLiens_ImageTri('titre');?>
            </th>
            <th class="utilisateur"> 
                <a href="<?php echo ListeLiens_Lien('utilisateur');?>"> Utilisateur </a>
                <?php ListeLiens_ImageTri('utilisateur');?>
            </th>
            <th class="date">
                <a href="<?php echo ListeLiens_Lien('date');?>"> Date </a>
                <?php ListeLiens_ImageTri('date');?>
            </th>
            <th class="visites">
                <a href="<?php echo ListeLiens_Lien('visites');?>"> Visites </a>
                <?php ListeLiens_ImageTri('visites');?>
            </th>
            <th class="action"> Action </th>
        </tr>
    </thead>
    <tbody>
    <?php $style=0; ?>
    <?php foreach ($page['data'] as $value): ?>
        <tr class="ligne<?php echo $style ?>">
            <td> 
                <a href="index.php?controller=liens&action=consulterlien&id=<?php echo $value['id']; ?>" target="blank"> 
                    <?php echo $value['titre']; ?> 
                </a> 
            </td>
            <td> <?php echo $value['identifiant']; ?> </td>
            <td> <?php echo date('d-m-Y',  strtotime($value['date'])); ?> </td>
            <td> <?php echo $value['visite']; ?> </td>
            <td> 
                <?php if(Proprietaire($value['utilisateur'])==TRUE): ?>
                <a href="index.php?controller=liens&action=editerlien&id=<?php echo $value['id']; ?>">
                     <img src="images/icone_editer.png" alt="Editer"/>
                </a>
                <a href="index.php?controller=liens&action=supprimerlien&id=<?php echo $value['id']; ?>">
                     <img src="images/icone_supprimer.png" alt="Supprimer"/>
                </a>
                <?php endif; ?>
            </td>
        </tr>
    <?php $style=1-$style; ?>
    <?php endforeach; ?>
    </tbody>
</table>