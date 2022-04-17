<div class="container">
<form method="POST">
    <fieldset>
        <legend><?= $text_legend ?></legend>
        <div class="input-wrapper n20">
            <label for="PrivilegeTitle"><?= $text_label_PrivilegeTitle ?></label>
            <input required type="text" name="PrivilegeTitle" id="PrivilegeTitle" maxlength="30">
        </div>
        <div class="input-wrapper n20">
            <label for="Privilege"><?= $text_label_Privilege ?></label>
            <input required type="text" name="Privilege" id="Privilege" maxlength="30">
        </div>
        <input type="submit" name="submit" value="<?= $text_label_save ?>">
    </fieldset>
</form>
</div>