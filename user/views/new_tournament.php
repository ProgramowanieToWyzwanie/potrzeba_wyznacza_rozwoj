<?php
if ($_SESSION['login_user']['role'] != 0){
    $_SESSION['error'] = "Nie masz uprawnień do tej akcji";
    header('Location: index.php');
}
?>

<div class=" border rounded p-4">
    <h4 class="text-center">Dodaj nowy turniej</h4>
    <form action="user/actions/add_tournament.php" method="POST">
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="inputEmail">Nazwa turnieju*</label>
                <input placeholder="Nazwa turnieju*" type="name" name="name" required class="form-control" id="inputEmail">
            </div>
            <div class="form-group col-md-12">
                <label for="inputName">Data rozgrywki*</label>
                <input placeholder="Data rozgrywki*" type="date" name="date" required class="form-control" id="inputName">
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Dodaj turniej</button>
        </div>
    </form>
</div>
