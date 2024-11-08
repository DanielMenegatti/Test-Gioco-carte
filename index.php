<?php

if (isset($_POST['csessione'])) {
    session_start();
    session_destroy();
    }
 session_start();
// Inizializza l'array delle giocate se non esiste
if (!isset($_SESSION['giocate'])) {
    $_SESSION['giocate'] = [];
}

// Gestisce il salvataggio delle giocate
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['salva'])) {
        $carta1 = $_POST['carta1'];
        $seme1 = $_POST['seme1'];
        $carta2 = $_POST['carta2'];
        $seme2 = $_POST['seme2'];
        $puntata = $_POST['puntata'];
        $data = $_POST['data'];       
        $vinta = $_POST['vinta'];

        // Salva la giocata in sessione
        $_SESSION['giocate'][] = [
            'carta1' => $carta1,
            'seme1' => $seme1,
            'carta2' => $carta2,
            'seme2' => $seme2,
            'puntata' => $puntata,
            'data' => $data,
            'vinta'=>$vinta,
        ];
    } elseif (isset($_POST['finisci'])) { //se il post riceve "finisci" viene mandato alla pagina risultati
        header('Location:incassi.php');
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="it">
<head>
<link rel="stylesheet" href="stile.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>I soldi vanno i matti restano</title>
</head>
<body>
    <h1>I soldi vanno i matti restano</h1>

    <form method="POST">
        <label>Seleziona carte</lable>
        <br>        

        <label for="carta1">Carta 1:</label>
   <select name="carta1" id="carta1">
   <option value="A">A</option>
   <?php for ($i = 2; $i <= 13; $i++): ?>
                <option value="<?= $i ?>"> <?= $i <= 10 ? $i : ['J', 'Q', 'K'][$i - 11] ?></option>
            <?php endfor; ?>
        </select>

        <select name="seme1" id="seme1">
            <option value="Cu">Cuori</option>
            <option value="Fi">Fiori</option>
            <option value="Pi">Picche</option>
            <option value="Qu">Quadri</option>
        </select>
        <br>
        <label for="carta2">Carta 2:</label>
        <select name="carta2" id="carta2">
        <option value="A">A</option>
        <?php for ($i = 2; $i <= 13; $i++): ?>
                <option value="<?= $i ?>"> <?= $i <= 10 ? $i : ['J', 'Q', 'K'][$i - 11] ?></option>
            <?php endfor; ?>
        </select>
        <select name="seme2" id="seme2">
            <option value="Cu">Cuori</option>
            <option value="Fi">Fiori</option>
            <option value="Pi">Picche</option>
            <option value="Qu">Quadri</option>
        </select>
        <br>
        <label for="puntata"> Puntata in €: </label>
        <input type="number" name="puntata" id="puntata" min="0" required>
        <br>
        <label for="data"> Data partita </label>
        <input type="date" name="data" id="data" required>
        <br>
        <label>Si _ No</label>
        <br>
        <input type="radio" id="vinta" name="vinta" value=true required>
        <input type="radio" id="vinta" name="vinta" value=false required>
        <label for="vinta">Partita vinta</label><br>
        <br>
        <button type="submit" name="salva">Salva partita</button>
        <br>
        <button type="reset" name="reset">Nuova partita</button>

        </form>
   <form method="POST">
        <button type="submit" name="finisci">Finisci partita</button> 
        <br>
        <button type="submit" name="csessione">Cancella partite</button>
   </form>
   <h2>Giocate recenti:</h2>
    <ul>
        <?php
        if (!isset($_SESSION['giocate']) || empty($_SESSION['giocate'])) {
    echo "Nessuna giocata salvata.";}
    else{foreach ($_SESSION['giocate'] as $giocata): ?>
            <li>Data: <?= $giocata['data'] ?> ,  <?= $giocata['carta1']  .  $giocata['seme1'] ?> - <?= $giocata['carta2']  .  $giocata['seme2'] ?> - Puntata: €<?= $giocata['puntata'] ?> Partita vinta? <?= $giocata['vinta']?></li>
        <?php endforeach;} ?>
    </ul>

</body>
</html>