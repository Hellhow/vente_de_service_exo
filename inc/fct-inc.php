<?php
// ANCHOR Fonction permettant de renommer un ficher sans accent et sans caractères non autorisés, à ajouter à votre fichier de fonctions personnelles
function str_to_noaccent(string $str)
{
    $url = $str;
    /* gestion des espacements ----------------------  */
    $url = preg_replace('#   #', '_', $url);
    $url = preg_replace('#  #', '_', $url);
    $url = preg_replace('# #', '_', $url);
    $url = preg_replace('#_-_#', '_', $url);
    $url = preg_replace('#___#', '_', $url);
    $url = preg_replace('#__#', '_', $url);
    $url = preg_replace("#'#", '-', $url);
    $url = preg_replace("#¨#", '', $url);
    /* caractères accentués -------------------------- */
    $url = preg_replace('#Ç#', 'C', $url);
    $url = preg_replace('#ç#', 'c', $url);
    $url = preg_replace('#è|é|ê|ë#', 'e', $url);
    $url = preg_replace('#È|É|Ê|Ë#', 'E', $url);
    $url = preg_replace('#à|á|â|ã|ä|å#', 'a', $url);
    $url = preg_replace('#@|À|Á|Â|Ã|Ä|Å#', 'A', $url);
    $url = preg_replace('#ì|í|î|ï#', 'i', $url);
    $url = preg_replace('#Ì|Í|Î|Ï#', 'I', $url);
    $url = preg_replace('#ð|ò|ó|ô|õ|ö#', 'o', $url);
    $url = preg_replace('#Ò|Ó|Ô|Õ|Ö#', 'O', $url);
    $url = preg_replace('#ù|ú|û|ü#', 'u', $url);
    $url = preg_replace('#Ù|Ú|Û|Ü#', 'U', $url);
    $url = preg_replace('#ý|ÿ#', 'y', $url);
    $url = preg_replace('#Ý#', 'Y', $url);
    $url = preg_replace('#ñ#', 'n', $url);
    $url = preg_replace('#Ñ#', 'N', $url);
    /* autres ----------------------------  */
    return ($url);
}

// ANCHOR traitement de txt (protège aussi des injections)
// penser à stripslashes($txt) pour l'afficher
function txtSlashes(string $txt)
{
    return $txt = htmlentities(addslashes(trim($txt)), ENT_QUOTES);
}

// ANCHORS fct qui renvoie les infos utiles du site
function infos_spy()
{
    // tab des cle utilisé pour connaître les infos utiles 
    $env = array(
        'remote_addr', 'http_accept_language', 'http_host', 'http_user_agent', 'script_filename', 'server_addr', 'server_name', 'server_signature', 'server_software', 'request_method', 'query_string', 'request_uri', 'script_name'
    );
    // tab qui va contenir les valeurs avec la clé associé des infos utiles
    $retour = array();
    foreach ($env as $key) {
        $retour[$key] = getenv($key);
    }
    return $retour;
}

// ANCHOR Contrôler si l'image est valide
function moveImage($image)
{
    if (isset($image) and $image['error'] == 0) {
        echo "====> Fichier reçu 👍<br>";
        // Testons si le fichier n'est pas trop gros
        if ($image['size'] <= 5000000) {
            echo "====> Taille Fichier < 5Mo 👍<br>";
            // Testons si l'extension est autorisée
            $infosfichier = pathinfo($image['name']);
            $extension_upload = $infosfichier['extension'];
            $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
            if (in_array($extension_upload, $extensions_autorisees)) {
                echo "====> Extension Autorisée 👍<br>";
                // On peut valider le fichier et le stocker définitivement
                move_uploaded_file($image['tmp_name'], 'uploads/images/' . basename($image['name']));
                //  FIXME Attention la même image peut pas être téléversée 2 fois
                echo "====> Téléversement de <strong>" . $image['name'] . "</strong> terminé 👍<br>";
                return $image['name'];
            } else {
                echo "⚠ Erreur: Ce format de fichier n'est pas autorisé";
            }
        } else {
            echo "⚠ Erreur: le fichier dépasse 1 Mo";
        }
    } else {
        echo "⚠ Erreur: Aucune photo reçue";
        return "";
    }
}

require_once($_SERVER['DOCUMENT_ROOT'] . '/php_exo5eurocom/inc/Database.php');

// // ANCHOR insertion de données
// // attention les array doivent avoir la même clé, donc utilisé les default key
// // $sth = $conn->prepare("requête sql d'INSERT")
// // appelle : $sthF =dbInsert($sth, ..., ...);
// function dbInsert($sth, array $params, array $vars)
// {
//     foreach ($params as $key => $value) {
//         $sth->bindParam($value, $vars[$key]);
//     }
//     return $sth->execute(); // order 66
// }

// ANCHOR afficher tous les postes
function getAll($table)
{
    try {
        // conn à la db
        $db = new Database();
        $conn = $db->getPDO();

        $sql = "SELECT * FROM $table";
        return $rows = $conn->query($sql)->fetchAll();
    } catch (PDOException $e) {
        echo "Erreur." . $e->getMessage();
    }
}

//ANCHOR READ Afficher un post
function getSingle($table, $id)
{
    try {
        // conn à la db
        $db = new Database();
        $conn = $db->getPDO();

        $sql = "SELECT * FROM $table WHERE ms_id = :id";
        $req = $conn->prepare($sql);
        $req->bindParam(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $row = $req->fetch();
        return $row;
    } catch (PDOException $e) {
        echo "Erreur." . $e->getMessage();
    }
}

// ANCHOR CREATE Créer
function create($table, $titre, $contenu, $prix, $image, $userID)
{
    try {
        // conn à la db
        $db = new Database();
        $connexion = $db->getPDO();

        $sql = "INSERT INTO $table (ms_titre, ms_contenu, ms_prix, ms_image, user_id) VALUES (:titre, :contenu, :prix, :image, :userID)";
        $req = $connexion->prepare($sql);
        $req->bindParam(':titre', $titre, PDO::PARAM_STR);
        $req->bindParam(':contenu', $contenu, PDO::PARAM_STR);
        $req->bindParam(':prix', $prix, PDO::PARAM_INT);
        $req->bindParam(':image', $image, PDO::PARAM_STR);
        $req->bindParam(':userID', $userID, PDO::PARAM_INT);
        $req->execute();
    } catch (PDOException $e) {
        echo "Erreur: " . $e->getMessage();
    }
}

// ANCHOR UPDATE Modifier
function update($table, $id, $titre, $contenu, $prix, $image, $userID)
{
    try {
        // conn à la db
        $db = new Database();
        $connexion = $db->getPDO();

        if (!empty($image)) {
            $sql = "UPDATE $table SET ms_titre = :titre, ms_contenu = :contenu, ms_prix = :prix, ms_image = :image, user_id = :userID WHERE microservice_id = :id ";
            $req = $connexion->prepare($sql);
            $req->bindParam(':titre', $titre, PDO::PARAM_STR);
            $req->bindParam(':contenu', $contenu, PDO::PARAM_STR);
            $req->bindParam(':prix', $prix, PDO::PARAM_INT);
            $req->bindParam(':image', $image, PDO::PARAM_STR);
            $req->bindParam(':userID', $userID, PDO::PARAM_INT);
            $req->bindParam(':id', $id, PDO::PARAM_INT);
            $req->execute();
        } else {
            $sql = "UPDATE $table SET ms_titre = :titre, ms_contenu = :contenu, ms_prix = :prix, user_id = :userID WHERE microservice_id = :id ";
            $req = $connexion->prepare($sql);
            $req->bindParam(':titre', $titre, PDO::PARAM_STR);
            $req->bindParam(':contenu', $contenu, PDO::PARAM_STR);
            $req->bindParam(':prix', $prix, PDO::PARAM_INT);
            $req->bindParam(':userID', $userID, PDO::PARAM_INT);
            $req->bindParam(':id', $id, PDO::PARAM_INT);
            $req->execute();
        }
    } catch (PDOException $e) {
        echo "Erreur: " . $e->getMessage();
    }
}


// ANCHOR DELETE Supprimer
function delete($table, $id)
{
    try {
        // conn à la db
        $db = new Database();
        $connexion = $db->getPDO();

        $sql = "DELETE FROM $table WHERE ms_id = :id";
        $req = $connexion->prepare($sql);
        $req->bindParam(':id', $id, PDO::PARAM_INT);
        $req->execute();
    } catch (PDOException $e) {
        echo "Erreur: " . $e->getMessage();
    }
}

// SECTION fct avec bootstrap

// ANCHOR Afficher en poste
function displayPosts($table)
{
    $rows = getAll($table);
    foreach ($rows as $row) :
        echo '
        <div class="col-md-4 p-2">
                <article class="shadow border border-secondary">
                    <div>
                        <img class="img-fluid" src="upload/image/placeholder-photo.jpg" alt="image_du_post">
                    </div>
                    <div class="p-2">
                        <h3>' . $row['ms_titre'] . '</h3>
                        <p>' . $row['ms_contenu'] . '</p>
                        <span class="btn btn-light">À partir de <strong>' . $row['ms_prix'] . ' €</strong></span>
                        <a class="link-secondary" href="./page/post.php?id=' . $row['ms_id'] . '">En savoir plus</a>
                    </div>
                </article>
            </div>
        ';
    endforeach;
    // urlencode(base64_encode(
}

// ANCHOR Afficher l'en-tête de la table
function getHeaderTable($table)
{
    try {
        $db = new Database();
        $connexion = $db->getPDO();
        $sql = "SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = :table_name ORDER BY ORDINAL_POSITION";
        $req = $connexion->prepare($sql);
        $req->bindParam(':table_name', $table, PDO::PARAM_STR);
        $req->execute();
        $rows = $req->fetchAll();
        return $rows;
    } catch (PDOException $e) {
        echo "Erreur: " . $e->getMessage();
    }
}

// ANCHOR dashboard | Afficher un tableau
function displayTable($table)
{
    $headers = getHeaderTable($table);
    $rows = getAll($table);
?>
    <table class="table table-hover table-light">
        <thead>
            <tr>
                <?php
                foreach ($headers as $header) :
                ?>
                    <th scope="col"><?= $header['COLUMN_NAME'] ?></th>
                <?php
                endforeach;
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($rows as $row) :
                // var_dump(array_key_first($row) ? 'yes' : $row);
            ?>
                <tr class="position-relative">
                    <td scope="col">
                        <a class="btn btn-link stretched-link text-decoration-none" href="add-ms.php?id=<?= $row['ms_id'] ?>">
                            <i class="bi bi-pencil-square"></i><?= $row['ms_id'] ?>
                        </a>
                    </td>
                    <td scope="col">
                        <?= $row['ms_titre'] ?>
                    </td>
                    <td scope="col">
                        <?= $row['ms_contenu'] ?>
                    </td>
                    <td scope="col">
                        <?= $row['ms_prix'] ?>
                    </td>
                    <td scope="col text-center">
                        <img src="<?= '../upload/image/' . $row['ms_image'] ?>" alt="<?= substr($row['ms_contenu'], 0, 80) ?>" width="120">
                    </td>
                    <td scope="col">
                        <?= $row['user_id'] ?>
                    </td>
                </tr>
            <?php
            endforeach;
            ?>
        </tbody>

    </table>
<?php
}

// !SECTION fct avec bootstrap