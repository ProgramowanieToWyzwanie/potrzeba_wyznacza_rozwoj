<?php
    session_start(); // startujemy sesje

    $_SESSION['login_errors'] = false; // ustawiamy zmienna sesyjna w której będziemy zapisywać komunikaty o błędach
    $_SESSION['login_success'] = false; // ustawiamy zmienna sesyjna w której będziemy zapisywać komunikaty powodzeniu


    $email = $_POST['email'];
    $password = $_POST['password'];


    if ($email === "") {
        $_SESSION['login_errors'][] = 'Nie podałeś adresu email';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['login_errors'][] = 'Podany adres email jest nie poprawny';
    }

    if (strlen($password) < 8) {
        $_SESSION['login_errors'][] = 'Nie poprawne hasło';
    }


    if ($_SESSION['login_errors'] === false) { // jesli nie napotkaliśmy błędów to zapisujemy użytkowniak

        if ($user = playerExist($email,$password)) {
            $_SESSION['login_success'] = "Zalogowany";
            $_SESSION['login'] = true;
            $_SESSION['login_user']['name'] = $user[0];
            $_SESSION['login_user']['email'] = $user[1];
            $_SESSION['login_user']['role'] = $user[3];
        } else {// jeśli taki użytkownik istnieje to wyświetlamy komunikat
            $_SESSION['login_errors'][] = "Błędny login lub hasło";
        }
    }


    header('Location: ../../index.php');


    /// ------- funkcje -------


    function playerExist($email, $password)
    {
        $handle = fopen("../../store/players.txt", "r");
        if ($handle) {
            while (($line = fgets($handle)) !== false) {

                $explodeLine = explode(';', $line);
                $emailFromFile = $explodeLine[1];
                $passwordFromFile = $explodeLine[2];

                if ($emailFromFile === $email && $passwordFromFile === md5($password)) { // znaleziono uzytkownika o takim emailu w pliku
                    fclose($handle);
                    return $explodeLine;
                }
            }
            return false; //nie znaleziono użytkownika o takim emailu w pliku
            fclose($handle);
        } else {
            $_SESSION['register_errors'][] = 'Problem z odczytem pliku';
        }
    }
