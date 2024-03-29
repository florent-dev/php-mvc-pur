<?php $title = 'Détail d\'un secteur'; ?>
<?php require 'templateHeader.php'; ?>

<div class="container">
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4"><?= $title ?> n°<?= $secteur->getId() ?></h1>
        </div>
    </div>

    <div>Id : <?= $secteur->getId() ?></div>
    <div>Nom : <?= $secteur->getLibelle() ?></div>

    <p class="mt-4">
        <a href='index.php?action=editorSecteur&id=<?= $secteur->getId() ?>'><button type="button" class="btn btn-info">Modifier</button></a>
        <a href='index.php?action=deleteSecteur&id=<?= $secteur->getId() ?>'><button type="button" class="btn btn-danger">Supprimer</button></a>
    </p>

    <hr>

    <ul class="list-group">
        <a href='index.php?action=viewSecteurs'><li class="list-group-item">Retour sur la liste des secteurs</li></a>
    </ul>
</div>

<?php require 'templateFooter.php'; ?>