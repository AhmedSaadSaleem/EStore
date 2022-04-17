<div class="container">
    <a href="/clients/create" class="button"><?= $text_add_item ?></a>
    <table class="data-table">
        <head>
            <th><?= $text_table_name ?></th>
            <th><?= $text_table_email ?></th>
            <th><?= $text_table_phone_number ?></th>
            <th><?= $text_table_address ?></th>
            <th><?= $text_table_control ?></th>
        </head>
        <tbody>
            <?php if($clients !== false){
                foreach($clients as $client){
            ?>
                    <tr>
                        <td><?= $client->Name ?></td>
                        <td><a href="mailto:<?= $client->Email ?>"><?= $client->Email ?></a></td>
                        <td><?= $client->PhoneNumber ?></td>
                        <td><?= $client->Address ?></td>
                        <td>
                            <a href="/clients/edit/<?= $client->ClientId ?>"><i class="fa-solid fa-file-pen"></i></a>
                            <a href="/clients/delete/<?= $client->ClientId ?>" onclick="if(!confirm('<?= $text_control_delete_confirm ?>')) return false;"><i class="fa-solid fa-trash-can"></i></a>
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