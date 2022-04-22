<div class="container">
    <a href="/productlist/create" class="button"><?= $text_add_item ?></a>
    <table class="data-table">
        <head>
            <th><?= $text_table_name ?></th>
            <th><?= $text_table_category ?></th>
            <th><?= $text_table_buy_price ?></th>
            <th><?= $text_table_sell_price ?></th>
            <th><?= $text_table_quantity ?></th>
            <th><?= $text_table_control ?></th>
        </head>
        <tbody>
            <?php if($products !== false){
                foreach($products as $product){
            ?>
                    <tr>
                        <td><?= $product->Name ?></td>
                        <td><?= $product->CategoryName ?></td>
                        <td><?= $product->BuyPrice ?></td>
                        <td><?= $product->SellPrice ?></td>
                        <td><?= $product->Quantity ?></td>
                        <td>
                            <a href="/productlist/edit/<?= $product->ProductId ?>"><i class="fa-solid fa-file-pen"></i></a>
                            <a href="/productlist/delete/<?= $product->ProductId ?>" onclick="if(!confirm('<?= $text_control_delete_confirm ?>')) return false;"><i class="fa-solid fa-trash-can"></i></a>
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