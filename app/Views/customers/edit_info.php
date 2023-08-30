<?php
/*
 * Project-name: devqualimp
 * File-name: edit_info.php
 * Author: WU
 * Start-Date: 2023/7/19 10:22
 */
?>

<h2><?= esc($title)?></h2>

<?= session()->getFlashdata('error') ?>
<?= validation_list_errors() ?>

<form action="/customers/edit_info" method="post">
    <?= csrf_field() ?>
    <input type="hidden" name="client_id" value="<?= esc($id)?>" >
    <label for="cli_name">Name</label>
    <input type="text" name="cli_name" value="<?= set_value('cli_name') ?>" >
    <br/>
    <label for="tel">Tel</label>
    <input type="text" name="tel" value="<?= set_value('tel') ?>" >
    <br/>
    <label for="email">Email</label>
    <input type="email" name="email" value="<?= set_value('email') ?>" >
    <br/>
    <label for="address">Address</label>
    <textarea name="address" cols="45" rows="4"><?= set_value('address') ?></textarea>
    <br/>
    <label for="password">Password</label>
    <input type="password" name="password" value="<?= set_value('password') ?>" >
    <br/>
    <label for="again_pwd">Password Again</label>
    <input type="password" name="again_pwd" onblur="check_both_pwd()" >
</form>
