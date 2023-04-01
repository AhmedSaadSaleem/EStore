<div class="users-create-view">
<form method="POST" enctype="application/x-www-form-urlencoded">
    <fieldset>
        <legend><?= $text_legend ?></legend>
        <div class="input-wrapper n20">
            <label for="FirstName"><?= $text_label_first_name ?></label>
            <input required type="text" name="FirstName" id="FirstName" maxlength="10" value="<?= $this->showValue('FirstName') ?>">
        </div>
        <div class="input-wrapper n20">
            <label for="LastName"><?= $text_label_last_name ?></label>
            <input required type="text" name="LastName" id="LastName" maxlength="10" value="<?= $this->showValue('LastName') ?>">
        </div>
        <div class="input-wrapper n20">
            <label for="Username"><?= $text_label_Username ?></label>
            <input required type="text" name="Username" id="Username" value="<?= $this->showValue('Username') ?>">
        </div>
        <div class="input-wrapper n20">
            <label for="Password"><?= $text_label_Password ?></label>
            <input required type="password" name="Password" id="Password">
        </div>
        <div class="input-wrapper n20">
            <label for="CPassword"><?= $text_label_CPassword ?></label>
            <input required type="password" name="CPassword" id="CPassword">
        </div>
        <div class="input-wrapper n20">
            <label for="Email"><?= $text_label_Email ?></label>
            <input required type="email" name="Email" id="Email" value="<?= $this->showValue('Email') ?>">
        </div>
        <div class="input-wrapper n20">
            <label for="CEmail"><?= $text_label_CEmail ?></label>
            <input required type="email" name="CEmail" id="CEmail"value="<?= $this->showValue('CEmail') ?>">
        </div>
        <div class="input-wrapper n20">
            <label for="PhoneNumber"><?= $text_label_PhoneNumber ?></label>
            <input required type="text" name="PhoneNumber" id="PhoneNumber" value="<?= $this->showValue('PhoneNumber') ?>">
        </div>
        <div class="input-wrapper n20">
            <select required name="GroupId">
            <option value=""><?= $text_user_GroupId ?></option>
                <?php if($goups !== false){ ?>
                <?php foreach($groups as $group){ ?>
                    <option value="<?= $group->GroupId ?>" <?= $this->selectedIF('GroupId', $group->GroupId) ?>><?= $group->GroupName ?></option>
                <?php
                      }
                    } else {

                    }
                  ?>
            </select>
        </div>
        <input type="submit" name="submit" value="<?= $text_label_save ?>">
    </fieldset>
</form>
</div>