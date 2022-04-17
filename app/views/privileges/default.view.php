<div class="container no-padding">
    <a href="/privileges/create" class="button"><?= $text_add_item ?></a>
    <table class="data-table">
        <head>
            <th><?= $text_table_privilege_name ?></th>
            <th><?= $text_table_control ?></th>
        </head>
        <tbody>
            <?php if($privileges !== false){
                foreach($privileges as $privilege){
            ?>
                    <tr>
                        <td><?= $privilege->PrivilegeTitle ?></td>
                        <td>
                            <a href="/privileges/edit/<?= $privilege->PrivilegeId ?>"><i class="fa-solid fa-file-pen"></i></a>
                            <a href="/privileges/delete/<?= $privilege->PrivilegeId ?>" onclick="if(!confirm('<?= $text_control_delete_confirm ?>')) return false;"><i class="fa-solid fa-trash-can"></i></a>
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