<div class="view-wrapper">
    <form method="POST" enctype="application/x-www-form-urlencoded">
            <div class="input-wrapper">
                <label for="Name"><?= $text_label_Name ?></label>
                <input class="input-style" required type="text" name="Name" id="Name" maxlength="40" value="<?= $this->showValue('Name') ?>">
            </div>
            <div class="input-wrapper">
                <label for="Email"><?= $text_label_Email ?></label>
                <input class="input-style" required type="email" name="Email" id="Email" maxlength="40" value="<?= $this->showValue('Email') ?>">
            </div>
            <div class="input-wrapper">
                <label for="PhoneNumber"><?= $text_label_PhoneNumber ?></label>
                <input class="input-style" required type="text" name="PhoneNumber" id="PhoneNumber" maxlength="15" value="<?= $this->showValue('PhoneNumber') ?>">
            </div>
            <div class="input-wrapper">
                <label for="Address"><?= $text_label_Address ?></label>
                <input class="input-style" required type="text" name="Address" id="Address" maxlength="50" value="<?= $this->showValue('Address') ?>">
            </div>
            <div class="input-wrapper">
                <input type="submit" name="submit" value="<?= $text_label_save ?>">
            </div>
    </form>
</div>