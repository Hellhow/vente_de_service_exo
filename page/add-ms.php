<?php

// ANCHOR inc des données et fct
require_once($_SERVER['DOCUMENT_ROOT'] . '/php_exo5eurocom/inc/fct-inc.php');


// var_dump($id);

$id = isset($_GET["id"]) ? $_GET["id"] : NULL;
if (!empty($id)) {
    $data = getSingle('ms_prod', $id);
    $action = "UPDATE";
    $libelle = "Mettre a jour";
} else {
    $action = "CREATE";
    $libelle = "Créer";
}

?>
<!doctype html>
<html lang="fr-FR">

<head>
    <?php
    $mainTitle = 'Microservice - add-ms';
    include($_SERVER['DOCUMENT_ROOT'] . '/php_exo5eurocom/inc/head.php');
    ?>
</head>

<body>
    <!-- SECTION header -->
    <?php
    $goRoot = '..';
    $goDoc1 = '.';
    include($_SERVER['DOCUMENT_ROOT'] . '/php_exo5eurocom/inc/header.php');
    ?>
    <!-- !SECTION header -->

    <main class="container">
        <div class="row">
            <h1>Microservices</h1>

        </div>
        <div class="row">
            <form class="my-2" action="controler-ms.php" method="POST" enctype="multipart/form-data">

                <input type="hidden" name="id" value="<?= $id ?>" />
                <input type="hidden" name="action" value="<?= $action ?>" />
                <div class="mb-3">
                    <label class="form-label" for="titre">Titre :</label>
                    <input class="form-control" type="text" id="titre" name="titre" value="<?= isset($data['Titre']) ? $data['Titre'] : NULL ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="contenu">Contenu :</label>
                    <textarea class="form-control" id="contenu" name="contenu" style="min-height:20vh;"><?= isset($data['Contenu']) ? $data['Contenu'] : NULL ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="prix">Prix :</label>
                    <input class="form-control" type="text" name="prix" value="<?= isset($data['Prix']) ? $data['Prix'] : NULL ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="userID">Utilisateur :</label>
                    <input class="form-control" type="text" name="userID" value="<?= isset($data['user_id']) ? $data['user_id'] : NULL ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="image">Ajouter une image :</label>
                    <input id="image" class="form-control" type="file" name="image"><br />
                </div>
                <button class="btn btn-primary" type="submit"><?= $libelle ?></button>
            </form>

            <?php if ($action != "CREATE") : ?>
                <form class="" action="controler-ms.php" method="POST">
                    <input type="hidden" name="action" value="DELETE" />
                    <input type="hidden" name="id" value="<?= $data['ms_id'] ?>" />
                    <button class="btn btn-danger" type="submit"><i class="bi bi-trash"></i> Supprimer</button>
                </form>
            <?php endif ?>
        </div>
    </main>

</body>

</html>