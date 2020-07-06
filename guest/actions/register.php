<?php
    session_start(); // startujemy sesje

    $_SESSION['register_errors'] = false; // ustawiamy zmienna sesyjna w której będziemy zapisywać komunikaty o błędach
    $_SESSION['register_success'] = false; // ustawiamy zmienna sesyjna w której będziemy zapisywać komunikaty powodzeniu

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    /// validacja danych

    if($name === ""){
        $_SESSION['register_errors'][] = 'Nie podałeś imienia';
    }

    if($email === ""){
        $_SESSION['register_errors'][] = 'Nie podałeś adresu email';
    }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $_SESSION['register_errors'][] = 'Podany adres email jest nie poprawny';
    }

    if(strlen($password) < 8){
        $_SESSION['register_errors'][] = 'Hasło powinno mieć minimum 8 znaków';
    }


    if($_SESSION['register_errors'] === false){ // jesli nie napotkaliśmy błędów to zapisujemy użytkowniak

        if(playerExist($email)){ // jeśli taki użytkownik istnieje to wyświetlamy komunikat
            $_SESSION['register_errors'][] = "Użytkownik o takim adresie e-mail już istnieje";
        }else{
            savePlayerToFile($name,$email,$password);
            sendEmail($email);
            $_SESSION['register_success'] = "Rejestracja przebiegłą pomyślnie, teraz możesz się zalogwać";
        }
    }


    header('Location: ../../index.php');


    /// ------- funkcje -------


    function playerExist($email){
        $handle = fopen("../../store/players.txt", "r");
        if ($handle) {
            while (($line = fgets($handle)) !== false) {

                $explodeLine = explode(';',$line);
                $emailFromFile = $explodeLine[1];
                if($emailFromFile == $email){ // znaleziono uzytkownika o takim emailu w pliku
                    fclose($handle);
                    return true;
                }
            }
            return false; //nie znaleziono użytkownika o takim emailu w pliku
            fclose($handle);
        } else {
            $_SESSION['register_errors'][] = 'Problem z odczytem pliku';
        }
    }

    function savePlayerToFile($name, $email, $password)
    {

        $file = fopen('../../store/players.txt', "a"); // otwarcie pliku w trybie dopisywania na końcu

        $dataToSave = $name . ';' . $email . ';' . md5($password) . ';1' . "\n"; // przygotowanie danych do zapisu

        fwrite($file, $dataToSave); // zapis danych w pliku
        fclose($file); // zamknięcie pliku
    }


    function sendEmail($email)
    {
        $headers = '';

        $playerSubject = 'Potwierdzenia rejestracji ';
        $playerMessage = 'Brawo właśnie zarejestrowałeś się teraz możesz się zalogować';

        return mail($email, $playerSubject, $playerMessage, $headers);
    }
