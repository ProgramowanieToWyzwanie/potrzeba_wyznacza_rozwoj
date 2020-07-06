
<div class="container col-md-6">
    <h1 class="text-center mt-4">Turniej FIFA</h1>
    <h3 class="text-center mt-4">Jeśli chcesz się zapisać zaloguj się, lub założ konto</h3>

    <br><br>

    <?php if(isset($_SESSION['error']) && $_SESSION['error']) {?>
        <div class="container mt-4">
            <div class="alert alert-danger" role="alert">
                <?php echo $_SESSION['error']; ?>
            </div>
        </div>
        <?php $_SESSION['error'] = false; ?>
    <?php } ?>


    <div class="row d-flex justify-content-between ">
        <div class="col-md-5 border rounded p-4">
            <h4 class="text-center mb-5">Zaloguj się</h4>


            <!--            Wyswietlanie komunikatu o nieprawdłowościach w formularzu rejestracji -->
            <?php if(!empty($_SESSION['login_errors'])){ ?>
                <div class="alert alert-danger text-center" role="alert">
                    <?php foreach($_SESSION['login_errors'] as $error) { ?>
                        <div><small> - <?php echo $error ?></small></div>
                    <?php } ?>
                </div>
                <?php $_SESSION['login_errors'] = false; ?>

            <?php } ?>

            <!--             Wyswietlanie komunikatu z powodzeniem rejestracji -->
            <?php if(!empty($_SESSION['login_success'])){ ?>
                <div class="alert alert-success text-center" role="alert">
                    <div><small> <?php echo $_SESSION['login_success'] ?></small></div>
                </div>
                <?php $_SESSION['login_success'] = false; ?>
            <?php } ?>

            <form action="guest/actions/login.php" method="POST">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputEmail">Email*</label>
                        <input placeholder="Email*" type="email" name="email" required class="form-control" id="inputEmail">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="inputName">Hasło*</label>
                        <input placeholder="Hasło*" type="password" name="password" required class="form-control" id="inputName">
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Zaloguj się</button>
                </div>
            </form>
        </div>

        <div class="col-md-5  border rounded p-4">
            <h4 class="text-center mb-5">Zarejestruj się</h4>

<!--            Wyswietlanie komunikatu o nieprawdłowościach w formularzu rejestracji -->
            <?php if(!empty($_SESSION['register_errors'])){ ?>
                <div class="alert alert-danger text-center" role="alert">
                    <?php foreach($_SESSION['register_errors'] as $error) { ?>
                        <div><small> - <?php echo $error ?></small></div>
                    <?php } ?>
                </div>
                <?php $_SESSION['register_errors'] = false; ?>

            <?php } ?>

<!--             Wyswietlanie komunikatu z powodzeniem rejestracji -->
            <?php if(!empty($_SESSION['register_success'])){ ?>
                <div class="alert alert-success text-center" role="alert">
                    <div><small> <?php echo $_SESSION['register_success'] ?></small></div>
                </div>
                <?php $_SESSION['register_success'] = false; ?>
            <?php } ?>

            <form action="guest/actions/register.php" method="POST">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputName">Imię*</label>
                        <input placeholder="Imię*" type="text" value="<?php echo isset($_POST['name']) ? $_POST['name'] : "" ; ?>" name="name" required class="form-control" id="inputName">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="inputEmail">Email*</label>
                        <input placeholder="Email*" type="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ""; ?>" required class="form-control" id="inputEmail">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="inputPassword">Hasło*</label>
                        <input placeholder="Hasło*" type="password" name="password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : ""  ;?>"  required class="form-control" id="inputPassword">
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Zarejestruj się</button>
                </div>
            </form>
        </div>
    </div>
