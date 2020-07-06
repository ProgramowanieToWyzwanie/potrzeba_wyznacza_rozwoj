<?php
    session_start(); // startujemy sesje
    session_destroy(); // usuwamy sesję

header('Location: ../../index.php');

