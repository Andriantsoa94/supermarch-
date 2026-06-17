<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion — Caisse Supermarché</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Sora:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/main.css') ?>">
</head>
<body>

<div class="page-center">
    <div class="card card--narrow">

        <!-- Logo / Brand -->
        <div class="brand-header">
            <div class="brand-icon">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7 18c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zM5.2 5H2V3H0v2h2l3.6 7.6L4.2 15A2 2 0 006 18h14v-2H6.4l1.1-2H18a2 2 0 001.7-1l3-5.5A1 1 0 0021.8 6H5.2z"/>
                </svg>
            </div>
            <h1>Caisse Enregistreuse</h1>
            <p>Connectez-vous pour accéder à votre caisse</p>
        </div>

        <?php if (isset($erreur)): ?>
            <div class="alert alert--error">
                <span class="alert-icon">⚠️</span>
                <span><?= esc($erreur) ?></span>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('/auth/authentifier') ?>" method="post" autocomplete="off">

            <div class="form-group">
                <label for="username">Identifiant</label>
                <input
                    type="text"
                    name="username"
                    id="username"
                    placeholder="admin"
                    value="admin"
                    required
                    autocomplete="off"
                >
                <div class="field-hint">
                    <span>Identifiant par défaut :</span>
                    <span class="hint-value">admin</span>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    placeholder="••••••••"
                    value="admin123"
                    required
                >
                <div class="field-hint">
                    <span>Mot de passe par défaut :</span>
                    <span class="hint-value">admin123</span>
                </div>
            </div>

            <button type="submit" class="btn btn--primary">
                Se connecter
            </button>

        </form>

        <p class="login-footer">Caisse Supermarché &copy; <?= date('Y') ?></p>

    </div>
</div>

</body>
</html>