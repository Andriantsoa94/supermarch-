<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saisie des achats — Supermarché</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Sora:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/main.css') ?>">
</head>
<body>

<div class="page-body">
    <div class="card card--wide">

        <!-- Top bar -->
        <div class="top-bar">
            <h2 class="top-bar__title">
                Saisie des achats
                <span>Caisse n° <?= esc($caisse_id) ?></span>
            </h2>
            <a href="<?= base_url('/caisse') ?>" class="btn btn--ghost">
                ↩ Changer de caisse
            </a>
        </div>

        <!-- Erreur flash -->
        <?php if (session()->getFlashdata('erreur')): ?>
            <div class="alert alert--error">
                <span class="alert-icon">⚠️</span>
                <span><?= esc(session()->getFlashdata('erreur')) ?></span>
            </div>
        <?php endif; ?>

        <form class="form-inline" action="<?= base_url('/achats/ajouter') ?>" method="post">

            <div class="form-group">
                <label for="produit_id">Produit</label>
                <select name="produit_id" id="produit_id" required>
                    <option value="">Sélectionner un produit</option>
                    <?php foreach ($produits as $p): ?>
                        <option value="<?= $p['id'] ?>">
                            <?= esc($p['designation']) ?> — <?= number_format($p['prix'], 0, ',', ' ') ?> Ar
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="quantite">Quantité</label>
                <input type="number" name="quantite" id="quantite" min="1" value="1" required>
            </div>

            <button type="submit" class="btn btn--success">
                + Ajouter
            </button>

        </form>

        <!-- Tableau des articles -->
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Prix unitaire</th>
                        <th>Quantité</th>
                        <th>Sous-total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($achats)): ?>
                        <tr>
                            <td colspan="4" class="td-empty">Aucun article saisi pour le moment.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($achats as $a): ?>
                            <tr>
                                <td><?= esc($a['designation']) ?></td>
                                <td class="td-amount"><?= number_format($a['prix'], 0, ',', ' ') ?> Ar</td>
                                <td><?= esc($a['quantite']) ?></td>
                                <td class="td-amount"><?= number_format($a['prix'] * $a['quantite'], 0, ',', ' ') ?> Ar</td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3">Total à payer</td>
                        <td class="td-amount"><?= number_format($total, 0, ',', ' ') ?> Ar</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Clôturer -->
        <form action="<?= base_url('/achats/cloturer') ?>" method="post">
            <button
                type="submit"
                class="btn btn--success-full"
                <?= empty($achats) ? 'disabled' : '' ?>
            >
                Clôturer l'achat
            </button>
        </form>

    </div>
</div>

</body>
</html>