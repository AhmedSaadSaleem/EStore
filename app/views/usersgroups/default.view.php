<div class="container">
    <a href="/usersgroups/create" class="button"><?= $text_add_item ?></a>
    <table class="data-table">
        <head>
            <th><?= $text_table_group_name ?></th>
            <th><?= $text_table_control ?></th>
        </head>
        <tbody>
            <?php if($groups !== false){
                foreach($groups as $group){
            ?>
                    <tr>
                        <td><?= $group->GroupName ?></td>
                        <td>
                            <a href="/usersgroups/edit/<?= $group->GroupId ?>"><i class="fa-solid fa-file-pen"></i></a>
                            <a href="/usersgroups/delete/<?= $group->GroupId ?>" onclick="if(!confirm('<?= $text_control_delete_confirm ?>')) return false;"><i class="fa-solid fa-trash-can"></i></a>
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