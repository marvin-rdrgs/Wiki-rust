<?php
$data = json_decode(file_get_contents("json/data.json"), true);
$weapon = $data["weapon"];

// Catégories uniques pour le filtre (générées depuis le JSON)
$categories = array_values(array_unique(array_column($weapon, "categorie")));
sort($categories);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Rust Wiki : tous les items du jeu Rust">
    <title>Items - Rust Wiki</title>

    <link rel="stylesheet" href="style/main.css">
    <script src="js/script.js" defer></script>
</head>

<body>
    <header class="header">
        <img src="img/page-web/logo.png" alt="Logo du jeu Rust" class="logo">
        <h1>RUST WIKI</h1>

        <nav class="nav">
            <a href="index.php" class="nav-link">Home</a>
            <a href="#" class="nav-link">Builds</a>
            <a href="#" class="nav-link">Calculator</a>
        </nav>
    </header>

    <main class="items-page">

        <div class="toolbar">
            <input
                type="search"
                id="search"
                class="toolbar-field"
                placeholder="Chercher un item..."
                aria-label="Chercher un item">

            <select id="categorie" class="toolbar-field" aria-label="Filtrer par catégorie">
                <option value="toutes">Toutes les catégories</option>
                <?php foreach ($categories as $c): ?>
                    <option value="<?= htmlspecialchars($c) ?>"><?= htmlspecialchars($c) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="items-grid">
            <?php foreach ($weapon as $w): ?>

                <article class="item-card arme"
                    data-nom="<?= htmlspecialchars(strtolower($w["nom"])) ?>"
                    data-categorie="<?= htmlspecialchars($w["categorie"]) ?>">

                    <a href="arme-detail.php?id=<?= urlencode($w["id"]) ?>" class="item-thumb">
                        <img
                            src="<?= htmlspecialchars($w["img"]) ?>"
                            class="item-img"
                            alt="<?= htmlspecialchars($w["nom"]) ?>"
                            loading="lazy">
                    </a>

                    <div class="item-body">
                        <h3 class="item-name"><?= htmlspecialchars($w["nom"]) ?></h3>
                        <p class="item-category"><?= htmlspecialchars($w["categorie"]) ?></p>
                        <p class="item-desc"><?= htmlspecialchars($w["description"]) ?></p>
                    </div>

                </article>

            <?php endforeach; ?>
        </div>

        <p class="no-result" id="no-result">Aucun item trouvé. Essaie un autre mot.</p>

    </main>

    <footer class="footer"></footer>

    <script>
        const recherche = document.getElementById("search");
        const categorie = document.getElementById("categorie");
        const armes = document.querySelectorAll(".arme");
        const aucunResultat = document.getElementById("no-result");

        function filtrerArmes() {
            const texte = recherche.value.toLowerCase().trim();
            const filtre = categorie.value;
            let visibles = 0;

            armes.forEach(arme => {
                const correspondNom = arme.dataset.nom.includes(texte);
                const correspondCategorie =
                    filtre === "toutes" || arme.dataset.categorie === filtre;
                const afficher = correspondNom && correspondCategorie;

                arme.style.display = afficher ? "" : "none";
                if (afficher) visibles++;
            });

            aucunResultat.classList.toggle("visible", visibles === 0);
        }

        recherche.addEventListener("input", filtrerArmes);
        categorie.addEventListener("change", filtrerArmes);
    </script>
</body>
</html>