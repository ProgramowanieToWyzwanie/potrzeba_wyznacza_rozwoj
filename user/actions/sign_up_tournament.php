<?php
session_start();
if (empty($_SESSION['login_user'])) {
    $_SESSION['error'] = "Nie masz uprawnień do tej akcji";
    header('Location: ../../index.php');
}

$file = $_GET['file'];

if (!playerExist($file, $_SESSION['login_user']['email'])) {
    savePlayerToTournament($file, $_SESSION['login_user']['name'], $_SESSION['login_user']['email']);

    $_SESSION['success'] = "Zapisałeś się na turniej!";
    header('Location: ../../index.php');
} else {
    $_SESSION['error'] = "Już jesteś zapisany na ten turniej";
    header('Location: ../../index.php');
}




/// ------- funkcje -------


function playerExist($file, $email)
{
    $handle = fopen('../../store/tournaments/' . $file, "r");
    if ($handle) {
        while (($line = fgets($handle)) !== false) {

            $explodeLine = explode(';', $line);
            $emailFromFile = $explodeLine[1];
            if ($emailFromFile == $email) { // znaleziono uzytkownika o takim emailu w pliku
                fclose($handle);
                return true;
            }
        }
        return false; //nie znaleziono użytkownika o takim emailu w pliku
        fclose($handle);
    }
}

function savePlayerToTournament($file, $name, $email)
{

    $file = fopen('../../store/tournaments/' . $file, "a"); // otwarcie pliku w trybie dopisywania na końcu

    $dataToSave = $name . ';' . $email . ';' . date('Y-m-d H:i:s') . "\n";

    fwrite($file, $dataToSave); // zapis danych w pliku
    fclose($file); // zamknięcie pliku
}
