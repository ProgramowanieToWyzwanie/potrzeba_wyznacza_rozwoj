<?php
$tournaments = file('store/tournaments.txt');

?>
<table class="table">
    <thead class="thead-dark">
    <tr>
        <th scope="col">#</th>
        <th scope="col">Nazwa turnieju</th>
        <th scope="col">Data</th>
        <th scope="col">Uczestnicy</th>
        <th scope="col">Zapisz się</th>
    </tr>
    </thead>
    <tbody>
    <?php if (count($tournaments) > 0) { ?>


        <?php $couner = 0; ?>
        <?php foreach ($tournaments as $tournament) {

            $tournamentData = explode(';', $tournament);
            $couner++;
            ?>

            <tr>
                <th scope="row"><?php echo $couner; ?></th>
                <td><?php echo $tournamentData[0]; ?></td>
                <td><?php echo $tournamentData[1]; ?></td>
                <td>
                    <a href="?action=tournament_players&file=<?php echo $tournamentData[2] ?>"
                       class="btn btn-outline-success btn-sm"> Uczestnicy</a>
                </td>
                <td>
                    <a href="user/actions/sign_up_tournament.php?file=<?php echo $tournamentData[2] ?>"
                       class="btn btn-outline-primary btn-sm"> Zapisz się</a>
                </td>
            </tr>

        <?php } ?>

    <?php } else { ?>
        <tr>
            <td colspan="5" class="text-center"> Nie ma jeszcze żadnego turnieju
                <?php if($_SESSION['login_user']['role'] == 0) { ?>
                    <a  href="?action=add_tournament">Dodaj nowy turniej</a>
                <?php } ?>
            </td>

        </tr>
    <?php } ?>
    </tbody>
</table>
