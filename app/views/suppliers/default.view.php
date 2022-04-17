<div class="container">
    <a href="/suppliers/create" class="button"><?= $text_add_item ?></a>
    <table class="data-table">
        <head>
            <th><?= $text_table_name ?></th>
            <th><?= $text_table_email ?></th>
            <th><?= $text_table_phone_number ?></th>
            <th><?= $text_table_address ?></th>
            <th><?= $text_table_control ?></th>
        </head>
        <tbody>
            <?php if($suppliers !== false){
                foreach($suppliers as $supplier){
            ?>
                    <tr>
                        <td><?= $supplier->Name ?></td>
                        <td><a href="mailto:<?= $supplier->Email ?>"><?= $supplier->Email ?></a></td>
                        <td><?= $supplier->PhoneNumber ?></td>
                        <td><?= $supplier->Address ?></td>
                        <td>
                            <a href="/suppliers/edit/<?= $supplier->SupplierId ?>"><i class="fa-solid fa-file-pen"></i></a>
                            <a href="/suppliers/delete/<?= $supplier->SupplierId ?>" onclick="if(!confirm('<?= $text_control_delete_confirm ?>')) return false;"><i class="fa-solid fa-trash-can"></i></a>
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