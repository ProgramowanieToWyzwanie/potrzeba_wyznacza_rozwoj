<?php
$file = $_GET['file'];
$players = file('store/tournaments/' . $file);

?>
<table class="table">
    <thead class="thead-dark">
    <tr>
        <th scope="col">#</th>
        <th scope="col">Imię</th>
        <th scope="col">Email</th>
        <th scope="col">Data zapisu</th>
    </tr>
    </thead>
    <tbody>
    <?php if (count($players) > 0) { ?>
        <?php $couner = 0; ?>
        <?php foreach ($players as $player) {

            $playerData = explode(';', $player);
            $couner++;
            ?>

            <tr>
                <th scope="row"><?php echo $couner; ?></th>
                <td><?php echo $playerData[0]; ?></td>
                <td><?php echo $playerData[1]; ?></td>
                <td><?php echo $playerData[2]; ?></td>
            </tr>

        <?php } ?>
    <?php } else { ?>
        <tr>
            <td colspan="4" class="text-center"> Nikt się jeszcze nie zapisał na ten turniej</td>
        </tr>
    <?php } ?>
    </tbody>
</table>
