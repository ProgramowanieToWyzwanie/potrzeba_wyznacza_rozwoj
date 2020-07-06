<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Turniej FIFA</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Lista turniejów</a>
            </li>
            <!--             Dostęp tylko dla uzytkownika z rola administratora-->
            <?php if ($_SESSION['login_user']['role'] == 0) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="?action=add_tournament">Dodaj nowy turniej</a>
                </li>
            <?php } ?>
        </ul>
    </div>

    <span>Witaj <strong> <?php echo $_SESSION['login_user']['name']; ?> </strong></span>
    <ul class="navbar-nav">
        <li class="nav-item active">
            <a class="nav-link" href="user/actions/logout.php">
                <svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-power" fill="currentColor"
                     xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M5.578 4.437a5 5 0 1 0 4.922.044l.5-.866a6 6 0 1 1-5.908-.053l.486.875z"/>
                    <path fill-rule="evenodd" d="M7.5 8V1h1v7h-1z"/>
                </svg>
            </a>
        </li>
    </ul>

</nav>


<div class="container mt-5">
    <?php if (isset($_SESSION['error']) && $_SESSION['error']) { ?>
        <div class="container mt-4 alert_container">
            <div class="alert alert-danger" role="alert">
                <?php echo $_SESSION['error']; ?>
            </div>
        </div>
        <?php $_SESSION['error'] = false; ?>
    <?php } ?>


    <?php if (isset($_SESSION['success']) && $_SESSION['success']) { ?>
        <div class="container mt-4 alert_container">
            <div class="alert alert-success" role="alert">
                <?php echo $_SESSION['success']; ?>
            </div>
        </div>
        <?php $_SESSION['success'] = false; ?>
    <?php } ?>

    <?php
    if (isset($_GET['action']) && $_GET['action'] == 'add_tournament') { // dodawanie nowego turnieju
        require_once "views/new_tournament.php";
    } elseif (isset($_GET['action']) && $_GET['action'] == 'tournament_players') { // lista zawodników w turnieju
        require_once "views/tournament_players.php";
    } else {
        require_once "views/tournaments_list.php"; // akcja domyslna czyli lista turniejów
    }

    ?>


</div>

<script>
    setTimeout(() => {
        const elements = document.querySelectorAll('.alert_container');
        elements.forEach(element => {
            element.remove();
        });
    }, 3000);

</script>
