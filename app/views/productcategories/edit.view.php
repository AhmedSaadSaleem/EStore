<div class="container">
<form autocomplete="off" method="POST" enctype="multipart/form-data">
    <fieldset>
        <legend><?= $text_legend ?></legend>
        <div class="input-wrapper n20">
            <label for="Name"><?= $text_label_Name ?></label>
            <input required type="text" name="Name" id="Name" maxlength="30" value="<?= $this->showValue('Name', $category) ?>">
        </div>
        <div class="input-wrapper n20">
            <label for="Image"><?= $text_label_Image ?></label>
            <input type="file" name="Image" accept="image/*" id="Image" maxlength="30">
        </div>
        <?php if($category->Image !== null){ ?>
            <div class="input-wrapper">
                <img src="/uploads/images/<?= $category->Image ?>" width="10%">
            </div>
        <?php }?>
        <input type="submit" name="submit" value="<?= $text_label_save ?>">
    </fieldset>
</form>
</div>