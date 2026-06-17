<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choisir une caisse — Supermarché</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Sora:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/main.css') ?>">
</head>
<body>

<div class="page-center">
    <div class="card card--narrow">

        <div class="brand-header">
            <div class="brand-icon">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 14H4V6h16v12zM6 10h2v2H6zm0 4h2v2H6zm4-4h2v2h-2zm0 4h2v2h-2zm4-4h4v6h-4z"/>
                </svg>
            </div>
            <h1>Choisir une caisse</h1>
            <p>Sélectionnez la caisse à ouvrir pour cette session</p>
        </div>

        <form action="<?= base_url('/caisse/valider') ?>" method="post">

            <div class="form-group">
                <label for="caisse_id">Caisse disponible</label>
                <select name="caisse_id" id="caisse_id" required>
                    <option value="">— Sélectionner une caisse —</option>
                    <?php foreach ($caisses as $c): ?>
                        <option value="<?= $c['id'] ?>">
                            Caisse n° <?= esc($c['numero']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn--primary">
                Ouvrir la caisse
            </button>

        </form>

    </div>
</div>

</body>
</html>