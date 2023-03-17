<?php
// ANCHOR inc des données et fct
require_once('../root.php');
require_once(SITE_ROOT . 'inc/fct-inc.php');
require_once(SITE_ROOT . 'inc/Database.php');
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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="SIRJACQUES Vincent">
    <meta name="copyright" content="SIRJACQUES Vincent">
    <meta name="robots" content="index, follow">
    <meta name="rating" content="general">

    <!-- ANCHOR titre -->
    <title>Exo vente de service</title>
    <meta name="description" content="...">

    <!-- ANCHOR icon de la page -->
    <!-- <link rel="shortcut icon" href="..." type="image/x-icon"> -->

    <!-- SECTION CSS -->

    <!-- ANCHOR CSS Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <!-- ANCHOR CSS framework -->
    <!-- <link rel="stylesheet" href="css/1_reset.css"> -->
    <!-- <link rel="stylesheet" href="css/2_normalize.css"> -->
    <link rel="stylesheet" href="../asset/bootstrap.css">
    <!-- <link rel="stylesheet" href="./css/mode.css"> -->

    <!-- ANCHOR CSS Custom-->
    <link rel="stylesheet" href="../css/main.css">
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
        <header>
            <h1 class="text-center mt-1 mb-3">Microservices</h1>
        </header>
        <!-- !SECTION header -->
        <!-- SECTION main -->
        <main>
            <div class="container">
                <div class="row">
                    <?php
                    displayTable(TABLE_PROD);
                    ?>
                </div>
            </div>
        </main>
        <!-- !SECTION main -->
        <!-- SECTION footer -->
        <footer>
            <a class="btn btn-primary" href="../index.php">Accueil</a>
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
    <script src="../asset/bootstrap.js"></script>
    <!-- !SECTION JS end -->
</body>

</html>