<?php
/*
 * Project-name: devqualimp
 * File-name: login.php
 * Author: WU
 * Start-Date: 2023/7/19 16:20
 */
?>
<?= validation_list_errors() ?>

<div class='container'>
    <div class='row justify-content-md-center'>

        <div class='col-6'>
            <h1>Sign In</h1>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>
            <form action="/login/signIn" method="post">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label for="InputForEmail" class="form-label">username</label>
                    <input type="text" name="username" class="form-control" id="InputForUsername"
                           value="<?= set_value('username') ?>">
                </div>
                <div class="mb-3">
                    <label for="InputForPassword" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="InputForPassword">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>

    </div>
</div>


<div class="video-box" style="display: none" >
    <video style="display: none" class='video-background' onclick="document.getElementsByClassName('form_login')[0].style.display = 'block';" preload='auto' loop playsinline autoplay tabindex='-1' muted='muted'>
        <source src='/asset/media/bgv.mp4' type='video/mp4'>
    </video>
    <div class='form_login'>
        <div id='form_login'>
            <p align='left'>statistics</p><br/>
            <input type='hidden' id='current_lang' value='en'/>
            <form action="signIn" method="post" >
                <?= csrf_field() ?>
                <table>
                    <tr>
                        <td>language:</td>
                        <td>
                            <select id="sel_lang" name="sel_lang">
                                <option value="fr">French</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>username :</td>
                        <td><input name="username" id="username" type="text" value="<?= set_value('username')?>" ></td>
                    </tr>
                    <tr>
                        <td>password :</td>
                        <td><input name="password" id="password" type="password" value="<?= set_value('password')?>" ></td>
                    </tr>
                    <tr>
                        <td colspan="2" height="40">
                            <center>
                                <input name="submit" id="submit" type="submit" value="Connexion">
                            </center>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>