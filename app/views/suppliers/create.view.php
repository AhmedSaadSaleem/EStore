<div class="container">
<form method="POST" enctype="application/x-www-form-urlencoded">
    <fieldset>
        <legend><?= $text_legend ?></legend>
        <div class="input-wrapper n20">
            <label for="Name"><?= $text_label_Name ?></label>
            <input required type="text" name="Name" id="Name" maxlength="40" value="<?= $this->showValue('Name') ?>">
        </div>
        <div class="input-wrapper n20">
            <label for="Email"><?= $text_label_Email ?></label>
            <input required type="email" name="Email" id="Email" maxlength="40" value="<?= $this->showValue('Email') ?>">
        </div>
        <div class="input-wrapper n20">
            <label for="PhoneNumber"><?= $text_label_PhoneNumber ?></label>
            <input required type="text" name="PhoneNumber" id="PhoneNumber" maxlength="15" value="<?= $this->showValue('PhoneNumber') ?>">
        </div>
        <div class="input-wrapper n20">
            <label for="Address"><?= $text_label_Address ?></label>
            <input required type="text" name="Address" id="Address" maxlength="50" value="<?= $this->showValue('Address') ?>">
        </div>
        <input type="submit" name="submit" value="<?= $text_label_save ?>">
    </fieldset>
</form>
</div>