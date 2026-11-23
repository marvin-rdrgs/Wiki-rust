<?php
$data = json_decode(file_get_contents("json/data.json"), true);
$builds = $data["build"];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Rust Wiki : tous les builds du jeu Rust">
    <title>Builds - Rust Wiki</title>

    <link rel="stylesheet" href="style/main.css">
    <script src="js/script.js" defer></script>
</head>

<body>
    <header class="header">
        <img src="img/page-web/logo.png" alt="Logo du jeu Rust" class="logo">
        <h1>RUST WIKI</h1>

        <nav class="nav">
            <a href="index.php" class="nav-link">Home</a>
            <a href="items.php" class="nav-link">Items</a>
            <a href="#" class="nav-link">Calculator</a>
        </nav>
    </header>

    <main class="items-page">

        <div class="toolbar">
            <input
                type="search"
                id="search"
                class="toolbar-field"
                placeholder="Chercher un build (nom, 4x4, bunker...)"
                aria-label="Chercher un build">
        </div>

        <div class="items-grid builds">
            <?php foreach ($builds as $b): ?>

                <article class="item-card build"
                    data-nom="<?= htmlspecialchars(strtolower($b["nom"] . " " . $b["tag"])) ?>">

                    <a href="build-detail.php?id=<?= urlencode($b["id"]) ?>" class="item-thumb">
                        <img
                            src="<?= htmlspecialchars($b["img"]) ?>"
                            class="item-img"
                            alt="<?= htmlspecialchars($b["nom"]) ?>"
                            loading="lazy">
                    </a>

                    <div class="item-body">
                        <h3 class="item-name"><?= htmlspecialchars(ucwords($b["nom"])) ?></h3>
                        <p class="item-category"><?= htmlspecialchars($b["tag"]) ?></p>
                    </div>

                </article>

            <?php endforeach; ?>
        </div>

        <p class="no-result" id="no-result">Aucun build trouvé. Essaie un autre mot.</p>

    </main>

    <footer class="footer"></footer>

    <script>
        const recherche = document.getElementById("search");
        const builds = document.querySelectorAll(".build");
        const aucunResultat = document.getElementById("no-result");

        recherche.addEventListener("input", () => {
            const texte = recherche.value.toLowerCase().trim();
            let visibles = 0;

            builds.forEach(build => {
                const afficher = build.dataset.nom.includes(texte);
                build.style.display = afficher ? "" : "none";
                if (afficher) visibles++;
            });

            aucunResultat.classList.toggle("visible", visibles === 0);
        });
    </script>
</body>
</html>