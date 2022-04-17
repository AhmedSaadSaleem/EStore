<div class="container">
    <a href="/productcategories/create" class="button"><?= $text_add_item ?></a>
    <table class="data-table">
        <head>
            <th><?= $text_table_category_name ?></th>
            <th><?= $text_table_category_image ?></th>
            <th><?= $text_table_control ?></th>
        </head>
        <tbody>
            <?php if($categories !== false){
                foreach($categories as $category){
            ?>
                    <tr>
                        <td><?= $category->Name ?></td>
                        <td><img src="/uploads/images/<?= $category->Image ?>" width="5%"></td>
                        <td>
                            <a href="/productcategories/edit/<?= $category->CategoryId ?>"><i class="fa-solid fa-file-pen"></i></a>
                            <a href="/productcategories/delete/<?= $category->CategoryId ?>" onclick="if(!confirm('<?= $text_control_delete_confirm ?>')) return false;"><i class="fa-solid fa-trash-can"></i></a>
                        </td>
                    </tr>
                    <?php }
                } else { ?>

                <tr>
                    <td colspan="6"><?= $text_data_not_exists ?></td>
                </tr>
            <?php

                } ?>
        </tbody>
    </table>
</div>