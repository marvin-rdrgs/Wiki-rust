<?php
$data = json_decode(file_get_contents("json/data.json"), true);
$weapon = $data["weapon"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des armes</title>
    <link rel="stylesheet" href="style/main.css">
</head>
<body>
    <header class="header">
        <img src="img/main/logo.png" alt="Logo du jeu Rust" class="logo">
        <h1>RUST WIKI</h1>

        <nav class="nav">
            <a href="items.php" class="nav-link">Items</a>
            <a href="#" class="nav-link">Builds</a>
            <a href="#" class="nav-link">Calculator</a>
        </nav>
    </header>
    <main>
        
            <?php foreach($weapon as $w): ?>

                <div class="section-div arme"
                    data-nom="<?= strtolower($w["nom"]) ?>"
                    data-categorie="<?= $w["categorie"] ?>">

                    <a href="arme-detail.php?id=<?= $w["id"] ?>">
                        <img
                            src="<?= htmlspecialchars($w["img"]) ?>"
                            class="affiche"
                            alt="<?= htmlspecialchars($w["nom"]) ?>">
                    </a>

                    <h3><?= htmlspecialchars($w["nom"]) ?></h3>

                    <p class="categorie">
                        <?= htmlspecialchars($w["categorie"]) ?>
                    </p>

                    <p class="description">
                        <?= htmlspecialchars($w["description"]) ?>
                    </p>

                </div>

            <?php endforeach; ?>
    <script>
        const recherche = document.getElementById("search");
        const categorie = document.getElementById("categorie");
        const armes = document.querySelectorAll(".arme");

        function filtrerArmes() {

            const texte = recherche.value.toLowerCase();
            const filtre = categorie.value;

            armes.forEach(arme => {

                const nom = arme.dataset.nom;
                const cat = arme.dataset.categorie;

                const correspondNom = nom.includes(texte);
                const correspondCategorie =
                    filtre === "toutes" || cat === filtre;

                if (correspondNom && correspondCategorie) {
                    arme.style.display = "";
                } else {
                    arme.style.display = "none";
                }

            });
        }

        recherche.addEventListener("input", filtrerArmes);
        categorie.addEventListener("change", filtrerArmes);
    </script>
    </main>
</body>
</html>