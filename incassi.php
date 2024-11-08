<?php
session_start();

// Controlla se ci sono giocate salvate
if (!isset($_SESSION['giocate']) || empty($_SESSION['giocate'])) {

    echo '<h3>Nessuna giocata salvata.</h3>';
    echo '<br>';    
    echo '<a href="index.php"><h3>Torna al modulo di inserimento</h3></a>';
    exit();
}

$montepremiTotale = 0;
?>

<!DOCTYPE html>
<html lang="it">
<head>
<link rel="stylesheet" href="stile.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incassi - I soldi vanno i matti restano</title>
</head>
<body>
    <h1>Incassi - I soldi vanno i matti restano</h1>
    <table>
        <tr>
            <th>Data</th>
            <th>Carta 1</th>
            <th>Carta 2</th>
            <th>Puntata (€)</th>
            <th>Vinta</th>
            <th>Montepremi (€)</th>
        </tr>
        <?php foreach ($_SESSION['giocate'] as $giocata): 
        if($giocata['vinta']==true)
        {
            $montepremi = $giocata['puntata'] * 2;
            $montepremiTotale += $montepremi;
        }
        else {$montepremi = 0;}

        ?>
            <tr>
                <td><?= $giocata['data'] ?></td>
                <td><?= $giocata['carta1'] . $giocata['seme1'] ?></td>
                <td><?= $giocata['carta2'] . $giocata['seme2'] ?></td>
                <td>€<?= $giocata['puntata'] ?></td>               
                 <td><?= $giocata['vinta'] ?></td>
                <td>€<?= $montepremi ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <h2>Montepremi Totale: €<?= $montepremiTotale ?></h2>
    <a href="index.php">Torna al modulo di inserimento</a>
</body>
</html>