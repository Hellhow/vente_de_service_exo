<?php

include  $_SERVER['DOCUMENT_ROOT'] . '/php_exo5eurocom/inc/fct-inc.php';

echo '$_REQUEST';
var_dump($_REQUEST);
echo '$_FILES';
var_dump($_FILES);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];
    $id = $_POST['id'];
    if ($action != 'DELETE') {
        $titre = txtSlashes($_POST['titre']);
        $contenu = txtSlashes($_POST['contenu']);
        $prix = (float)txtSlashes($_POST['prix']);
        $image = txtSlashes(moveImage($_FILES['image']));
        $userID = (int) txtSlashes($_POST['userID']);
    }

    // session_unset();
    switch ($action):
        case 'CREATE':
            create('ms_prod', $titre, $contenu, $prix, $image, $userID);
            echo $_SESSION['message'] = '<p class="text-success my-2">Element créé</p>';
            // header('Location:'.WEB_ROOT.'admin/');
            break;
        case 'UPDATE':
            update('ms_prod', $id, $titre, $contenu, $prix, $image, $userID);
            echo $_SESSION['message'] = '<p class="text-success my-2">Element mis à jour</p>';
            // header('Location:'.WEB_ROOT.'admin/');
            break;
        case 'DELETE':
            delete('ms_prod', $id);
            echo $_SESSION['message'] = '<p class="text-success my-2">Element supprimé</p>';
            // header('Location:'.WEB_ROOT.'admin/');
            break;

        default:
            echo '<p>⚠ un problème est survenu</p>';
            break;
    endswitch;
}
?>

<a href="/crud/dashboard.php">Admin</a>