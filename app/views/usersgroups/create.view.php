<div class="container">
<form method="POST">
    <fieldset>
        <legend><?= $text_legend ?></legend>
        <div class="input-wrapper n20">
            <label for="GroupName"><?= $text_label_GroupName ?></label>
            <input required type="text" name="GroupName" id="GroupName" maxlength="30">
        </div>
        <P class="padding10"><?= $text_label_Privileges ?></p>
        <?php if($privileges !== false){ foreach($privileges as $privilege){?>
        <div class="input-wrapper check-box">
            <input type="checkbox" name="Privileges[]" id="<?= $privilege->PrivilegeTitle ?>" maxlength="30" value="<?= $privilege->PrivilegeId ?>">
            <label for="<?= $privilege->PrivilegeTitle ?>"><?= $privilege->PrivilegeTitle ?></label>
        </div>
        <?php
        }} else {?>
            <p></p>
        <?php
        }
        ?>
        <input type="submit" name="submit" value="<?= $text_label_save ?>">
    </fieldset>
</form>
</div>