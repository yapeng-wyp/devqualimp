<?php
/*
 * Project-name: devqualimp
 * File-name: view.php
 * Author: WU
 * Start-Date: 2023/7/18 13:33
 */
?>

<h2><?= esc($sub_title) ?></h2>


<?php if (!empty($infos) && is_array($infos)): ?>
    <form name="vm_info" id="vm_info" method="post" action="edit_info/id=<?= esc($id)?>">
        <?= csrf_field() ?>
        <table id="vm_info_table">
            <tr style="border: 2px #000 solid">
                <th style="text-align: center" >name</th>
                <th style="text-align: center" >Tel</th>
                <th style="text-align: center" >Email</th>
                <th style="text-align: center" >Address</th>
            </tr>
            <?php foreach ($infos as $info): ?>
            <tr>
                <td><?= esc($info['client_Nom']) ?></td>
                <td><?= esc($info['client_Tel']) ?></td>
                <td><?= esc($info['client_Email'] )?></td>
                <td><?= esc($info['client_Adr']) ?></td>
            </tr>
            <?php endforeach;?>
            <tr>
                <td colspan="4" style="text-align: center"><input type="submit" name="edit_info" value="Update this info" ></td>
            </tr>
        </table>
    </form>
<?php endif; ?>
