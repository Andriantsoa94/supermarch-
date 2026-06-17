<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <p>Choisir Caisse</p>
    
    <form action="<?= base_url('/caisse/valider') ?>" method="post">
        <select name="caisse_id" required>
            <option value="">Sélectionner Caisse</option>
            
            <?php foreach($caisses as $c) { ?>
                <option value="<?= $c['id'] ?>">
                    Caisse n :<?= $c['numero'] ?>
                </option>
            <?php } ?>
            
        </select>
        
        <br><br>
        <button type="submit">Valider</button>
    </form>
</body>

</html>