<div class="container">
    <a href="/users/create" class="button"><?= $text_add_item ?></a>
    <table class="data-table">
        <head>
            <th><?= $text_table_user_name ?></th>
            <th><?= $text_table_email ?></th>
            <th><?= $text_table_phone_number ?></th>
            <th><?= $text_table_join_date ?></th>
            <th><?= $text_table_last_login ?></th>
            <th><?= $text_table_group_name ?></th>
            <th><?= $text_table_control ?></th>
        </head>
        <tbody>
            <?php if($users !== false){
                foreach($users as $user){
            ?>
                    <tr>
                        <td><?= $user->UserName ?></td>
                        <td><a href="mailto:<?= $user->Email ?>"><?= $user->Email ?></a></td>
                        <td><?= $user->PhoneNumber ?></td>
                        <td><?= $user->JoinDate ?></td>
                        <td><?= $user->LastLogin ?></td>
                        <td><?= $user->GroupName ?></td>
                        <td>
                            <a href="/users/edit/<?= $user->UserId ?>"><i class="fa-solid fa-file-pen"></i></a>
                            <a href="/users/delete/<?= $user->UserId ?>" onclick="if(!confirm('<?= $text_control_delete_confirm ?>')) return false;"><i class="fa-solid fa-trash-can"></i></a>
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