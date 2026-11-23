<?php 
    $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

    $data = json_decode(file_get_contents('json/data.json'), true);

    $weaponsById = array_column($data['tools'], null, 'id');
    $weapon = $weaponsById[$id] ?? null;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Rust Wiki : tous les items du jeu Rust">
    <title>Item - Rust Wiki</title>

    <link rel="stylesheet" href="style/main.css">
    <script src="js/script.js" defer></script>
</head>
<body>
    <header class="header">
        <img src="img/page-web/logo.png" alt="Logo du jeu Rust" class="logo">
        <h1>RUST WIKI</h1>

        <nav class="nav">
            <a href="items.php" class="nav-link">Items</a>
            <a href="build.php" class="nav-link">Builds</a>
            <a href="#" class="nav-link">Calculator</a>
        </nav>
    </header>

    <img
        src="<?= htmlspecialchars($weapon["img"]) ?>"
        class="item-img"
        alt="<?= htmlspecialchars($weapon["nom"]) ?>"
        loading="lazy">
</body>
</html>