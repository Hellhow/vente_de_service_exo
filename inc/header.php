<nav class="navbar navbar-expand-lg bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= $goRoot . '/index.php' ?>"><img src="https://api.dicebear.com/5.x/identicon/svg?seed=Microservices" alt="" height="20"> Microservices</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= $goRoot . '/index.php' ?>">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $goDoc1 . '/dashboard.php' ?>">Dashboard</a>
                </li>
                </li>
            </ul>
        </div>
    </div>
</nav>
<?= '<span>' . substr($_SERVER['PHP_SELF'], 1) . '</span>';
