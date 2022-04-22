<nav>
    <div class="container">
        <div class="links">
            <ul>
                <li><a class="<?= $this->matchUrl('/') ? 'selected' : '' ?>" href="/" traget=""><i class="fa-solid fa-house"></i> <?= $text_home ?></a></li>
                <li><a class="<?= $this->matchUrl('/transactions') ? 'selected' : '' ?>" href="/transactions" traget=""><i class="fa-solid fa-money-simple-from-bracket"></i> <?= $text_transactions ?></a></li>
                <li><a class="<?= $this->matchUrl('/expenses') ? 'selected' : '' ?>" href="/expenses" traget=""><i class="fa-solid fa-magnifying-glass-dollar"></i> <?= $text_expenses ?></a></li>
                <li>
                    <a class="<?= $this->matchUrl('/store') ? 'selected' : '' ?>" href="/store" traget=""><i class="fa-solid fa-shop"></i> <?= $text_store ?></a>
                    <ul class="branch">
                        <li><a class="<?= $this->matchUrl('/productcategories') ? 'selected' : '' ?>" href="/productcategories" traget=""><?= $text_store_categories ?></a></li>
                        <li><a class="<?= $this->matchUrl('/productlist') ? 'selected' : '' ?>" href="/productlist" traget=""><?= $text_store_products ?></a></li>
                    </ul>
                </li>
                <li><a class="<?= $this->matchUrl('/clients') ? 'selected' : '' ?>" href="/clients" traget=""><i class="fa-solid fa-users"></i> <?= $text_clients ?></a></li>
                <li><a class="<?= $this->matchUrl('/suppliers') ? 'selected' : '' ?>" href="/suppliers" traget=""><i class="fa-solid fa-boxes-packing"></i> <?= $text_suppliers ?></a></li>
                <li>
                    <a  class="<?= $this->matchUrl('/users') ? 'selected' : '' ?>" href="/users" traget=""><i class="fa-solid fa-user"></i> <?= $text_users ?></a>
                    <ul class="branch">
                        <li><a class="<?= $this->matchUrl('/usersgroups') ? 'selected' : '' ?>" href="/usersgroups" traget=""><?= $text_users_groups ?></a></li>
                        <li><a class="<?= $this->matchUrl('/privileges') ? 'selected' : '' ?>" href="/privileges" traget=""><?= $text_users_privileges ?></a></li>
                    </ul>
                </li>
                <li><a class="<?= $this->matchUrl('/reports') ? 'selected' : '' ?>" href="/reports" traget=""><i class="fa-solid fa-file-chart-pie"></i> <?= $text_reports ?></a></li>
                <li><a class="<?= $this->matchUrl('/auth/logout') ? 'selected' : '' ?>" href="/auth/logout" traget=""><i class="fa-solid fa-right-from-bracket"></i> <?= $text_logout ?></a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <div class="messages">
        <div class="container">
            <?php 
                $messages = $this->messenger->getMessages();
                if(!empty($messages)){
                    foreach($messages as $message){?>
                        <p class="message t<?= $message[1] ?>"><?= $message[0] ?></p>
            <?php 
                    }
                }
            ?>
                
        </div>
    </div>
</div>