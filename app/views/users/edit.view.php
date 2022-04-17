<div class="container">
<form method="POST" enctype="application/x-www-form-urlencoded">
    <fieldset>
        <legend><?= $text_legend ?></legend>
        <div class="input-wrapper n20">
            <label for="Username"><?= $text_label_Username ?></label>
            <input disabled required type="text" name="Username" id="Username" value="<?= $this->showValue('UserName', $user) ?>">
        </div>
        <div class="input-wrapper n20">
            <label for="Email"><?= $text_label_Email ?></label>
            <input disabled required type="email" name="Email" id="Email" value="<?= $this->showValue('Email', $user) ?>">
        </div>
        <div class="input-wrapper n20">
            <label for="CEmail"><?= $text_label_CEmail ?></label>
            <input disabled required type="email" name="CEmail" id="CEmail"value="<?= $this->showValue('Email', $user) ?>">
        </div>
        <div class="input-wrapper n20">
            <label for="PhoneNumber"><?= $text_label_PhoneNumber ?></label>
            <input required type="text" name="PhoneNumber" id="PhoneNumber" value="<?= $this->showValue('PhoneNumber', $user) ?>">
        </div>
        <div class="input-wrapper n20">
            <select required name="GroupId">
            <option value=""><?= $text_user_GroupId ?></option>
                <?php if($goups !== false){ ?>
                <?php foreach($groups as $group){ ?>
                    <option value="<?= $group->GroupId ?>" <?= $this->selectedIF('GroupId', $group->GroupId, $user) ?>><?= $group->GroupName ?></option>
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