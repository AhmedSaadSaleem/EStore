<div class="login-page">
    <div class="container">
        <?php $messages = $this->messenger->getMessages(); if(!empty($messages)): foreach ($messages as $message): ?>
            <p class="message t<?= $message[1] ?>"><?= $message[0] ?><a href="" class="closeBtn"><i class="fa fa-times"></i></a></p>
        <?php endforeach;endif; ?>
        <div class="login">
            <div class="container">
                <form  method="post" enctype="application/x-www-form-urlencoded">
                    <div class="login-box">
                        <h1><?= $login_header ?></h1>
                        <div class="input-wrapper n80">
                            <label for="ucname"><?= $login_ucname ?></label>
                            <input required type="text" name="ucname" id="ucname" maxlength="50" placeholder="<?= $login_ucname ?>">
                        </div>
                        <div class="input-wrapper n80">
                            <label for="ucpwd"><?= $login_ucpwd ?></label>
                            <input required type="password" id="ucpwd" name="ucpwd" maxlength="100" placeholder="<?= $login_ucpwd ?>">
                        </div>
                        <input type="submit" name="login" value="<?= $login_button ?>">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
