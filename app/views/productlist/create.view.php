<div class="container">
<form autocomplete="off" method="POST" enctype="multipart/form-data">
    <fieldset>
        <legend><?= $text_legend ?></legend>
        <div class="input-wrapper n20">
            <label for="Name"><?= $text_label_Name ?></label>
            <input required type="text" name="Name" id="Name" maxlength="50" value="<?= $this->showValue('Name') ?>">
        </div>
        <div class="input-wrapper n20">
        <select required name="CategoryId">
            <option value=""><?= $text_label_CategoryId ?></option>
                <?php if($categories !== false){ ?>
                <?php foreach($categories as $category){ ?>
                    <option value="<?= $category->CategoryId ?>" <?= $this->selectedIf('CategoryId', $category->CategoryId) ?>><?= $category->Name ?></option>
                <?php
                      }
                    } else {

                    }
                  ?>
            </select>
        </div>
        <div class="input-wrapper n20">
            <label for="Quantity"><?= $text_label_Quantity ?></label>
            <input required type="number" name="Quantity" id="Quantity" min="1" step="1" value="<?= $this->showValue('Quantity') ?>">
        </div>
        <div class="input-wrapper n20">
            <label for="BuyPrice"><?= $text_label_BuyPrice ?></label>
            <input required type="number" name="BuyPrice" id="BuyPrice" min="1" step="0.01" value="<?= $this->showValue('BuyPrice') ?>">
        </div>
        <div class="input-wrapper n20">
            <label for="SellPrice"><?= $text_label_SellPrice ?></label>
            <input required type="number" name="SellPrice" id="SellPrice" min="1" step="0.01" value="<?= $this->showValue('SellPrice') ?>">
        </div>
        <div class="input-wrapper n20">
            <select required name="Unit">
                    <option value=""><?= $text_label_Unit ?></option>
                    <option value="1" <?= $this->selectedIf('Unit', 1) ?>><?= $text_unit_1 ?></option>
                    <option value="2" <?= $this->selectedIf('Unit', 2) ?>><?= $text_unit_2 ?></option>
                    <option value="3" <?= $this->selectedIf('Unit', 3) ?>><?= $text_unit_3 ?></option>
                    <option value="4" <?= $this->selectedIf('Unit', 4) ?>><?= $text_unit_4 ?></option>
            </select>
        </div>
        <div class="input-wrapper n20">
            <label for="Image"><?= $text_label_Image ?></label>
            <input type="file" name="Image" accept="image/*" id="Image" maxlength="30">
        </div>
        <input type="submit" name="submit" value="<?= $text_label_save ?>">
    </fieldset>
</form>
</div>