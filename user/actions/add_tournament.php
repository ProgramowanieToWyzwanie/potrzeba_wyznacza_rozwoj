<?php
session_start();

if ($_SESSION['login_user']['role'] != 0) {
    $_SESSION['error'] = "Nie masz uprawnień do tej akcji";
    header('Location: ../index.php');
}


if (!empty($_POST['name']) && !empty($_POST['date'])) {
    $fileName = strtolower(str_replace(" ", "_", $_POST['name']) . '_' . str_replace("-", "", $_POST['date'])) . '.txt';
    $file = fopen('../../store/tournaments/' . $fileName, 'w') or die('Error opening file: ' + $fileName);
    fclose($file);

    // zapis turnieju w pliku z turniejami
    $tournamentsFile = fopen('../../store/tournaments.txt', "a");
    $dataToSave =  $_POST['name'] . ';' . $_POST['date'].';'.$fileName. "\n";
    fwrite($tournamentsFile, $dataToSave);
    fclose($tournamentsFile);

    $_SESSION['success'] = "Dodano nowy turniej";
    header('Location: ../../index.php');

} else {
    $_SESSION['error'] = "Nie poprawne dane formularza";
    header('Location: ../index.php');
}
