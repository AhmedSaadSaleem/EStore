<div class="login-view bg-white center-flex">
    <h1 class="logo mb-20">Micro Volt</h1>
    <div class="login-wrapper p-relative">
        <div class="login rad-10">
            <h2 class="txt-c"><?= $login_header ?></h2>
            <form  method="post" enctype="application/x-www-form-urlencoded">
                    <div class="">
                        <label class="d-block mb-5" for="ucname"><?= $login_ucname ?></label>
                        <input class="input-style bg-white p-10 d-block w-full" required type="text" name="ucname" id="ucname" maxlength="50" placeholder="<?= $login_ucname ?>">
                    </div>
                    <div class="">
                        <label class="d-block mb-5" for="ucpwd"><?= $login_ucpwd ?></label>
                        <input class="input-style bg-white p-10 d-block w-full" required type="password" id="ucpwd" name="ucpwd" maxlength="100" placeholder="<?= $login_ucpwd ?>">
                    </div>
                    <input class="d-block mt-20 btn-shape" type="submit" name="login" value="<?= $login_button ?>">
            </form>
        </div>
        <?php $messages = $this->messenger->getMessages(); if(!empty($messages)): foreach ($messages as $message): ?>
        <p class="w-full txt-c pt-20 c-red p-absolute message t<?= $message[1] ?>"><?= $message[0] ?> <a href="" class="closeBtn"><i class="fa fa-times"></i></a></p>
        <?php endforeach;endif; ?>
    </div>
</div>