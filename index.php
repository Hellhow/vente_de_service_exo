<?php
// ANCHOR inc des données et fct
require_once($_SERVER['DOCUMENT_ROOT'] . '/php_exo5eurocom/inc/fct-inc.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/php_exo5eurocom/inc/Database.php');
?>
<!DOCTYPE html>

<!-- ANCHOR Signature

    ._________.
    | > \   < |
    | \\[T]// |
    |  \|O|/  |
    |   |Y|   |
    |  _|||_  |
    |_________|

 -->

<html lang="FR-fr">

<head>
    <?php
    $mainTitle = 'Microservices - accueil';
    include($_SERVER['DOCUMENT_ROOT'] . '/php_exo5eurocom/inc/head.php');
    ?>

    <!-- SECTION CSS -->
    <!-- ANCHOR CSS framework Custom -->
    <!-- <link rel="stylesheet" href="css/1_reset.css"> -->
    <!-- <link rel="stylesheet" href="css/2_normalize.css"> -->
    <!-- <link rel="stylesheet" href="./css/mode.css"> -->

    <!-- ANCHOR CSS Custom-->
    <link rel="stylesheet" href="./css/main.css">
    <!-- !SECTION CSS -->

    <!-- SECTION JS__head -->
    <!-- <script src="./js/main.js" defer></script> -->
    <!-- !SECTION JS__head -->

</head>

<body class="bg-dark text-bg-dark m-auto w-75">
    <!-- SECTION php connexion -->
    <?php
    try {
        // conn à la db
        $db = new Database();
        $conn = $db->getPDO();
    ?>
        <!-- !SECTION php co -->
        <!-- SECTION header -->
        <?php
        $goRoot = '.';
        $goDoc1 = './page';
        include($_SERVER['DOCUMENT_ROOT'] . '/php_exo5eurocom/inc/header.php');
        ?>
        <!-- !SECTION header -->
        <!-- SECTION main -->
        <main>
            <h1 class="text-center mt-1 mb-3">Microservices</h1>
            <div class="container">
                <div class="row">
                    <?php
                    displayPosts(TABLE_PROD);
                    ?>
                </div>
            </div>
        </main>
        <!-- !SECTION main -->
        <!-- SECTION footer -->
        <footer>

        </footer>
        <!-- !SECTION footer -->
        <!-- SECTION php co erreur + déco -->
    <?php
    } catch (PDOException $e) {
        echo "Erreur." . $e->getMessage();
    }
    // On ferme la co
    $conn = null;
    ?>
    <!-- !SECTION php co erreur + déco -->
    <!-- SECTION JS end -->
    <script src="./asset/bootstrap.js"></script>
    <!-- !SECTION JS end -->
</body>

</html>