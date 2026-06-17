<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Liste Produit</h1>

    <form id="formulaire">
    
        <select name="produit_id" id="">
            <?php foreach ($produits as $produit): ?>
                <option value="<?= $produit['id'] ?>"><?= $produit['designation'] ?></option>
            <?php endforeach; ?>
        </select>
        <br><br>

        <input type="number" name="quantite" placeholder="Quantité" required>

        <button onclick="valider()" >Valider</button>
    </form>

    <table border="1"">
        <thead>
            <tr>
                <th>Produit</th>
                <th>Prix Unitaire</th>
                <th>Quantité</th>
                <th>Montant</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Riz</td>
                <td>200</td>
                <td>2</td>
                <td>24000</td>
            </tr>
            <tr>
                <td>Lait</td>
                <td>5000</td>
                <td>1</td>
                <td>5000</td>
            </tr>
        </tbody>    
    </table>

    <script src="<?= base_url('js/achat.js') ?>" ></script>
</body>
</html>