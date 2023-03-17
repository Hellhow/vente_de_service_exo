<?php
include($_SERVER['DOCUMENT_ROOT'] . '/php_exo5eurocom/inc/fct-inc.php');

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
<html lang="en">

<head>
    <?php
    $mainTitle = 'Microservice - post';
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
        <div class="row justify-content-center">
            <article class="col-md-6 p-2">
                <div class=" text-center">
                    <?= isset($data['ms_image']) ? '<img class="img-fluid" src="../upload/image/' . $data["ms_image"] . '" alt="' . $data['ms_image'] . '"' : NULL ?>
                </div>
                <?= isset($data['ms_titre']) ? '<h1>' . $data['ms_titre'] . '</h1>' : NULL ?>
                <?= isset($data['ms_contenu']) ? '<p>' . $data['ms_contenu'] . '</p>' : NULL ?>
                <?= isset($data['ms_prix']) ? '<p class="fs-1">Prix: ' . $data['ms_prix'] . '</p>' : NULL ?>
                <div>
                    <a class="btn btn-primary" href="../index.php">Retour</a>
                </div>
            </article>
        </div>
    </main>

</body>

</html>