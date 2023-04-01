<div class="page-top d-flex">
    <div class="sidebar bg-white p-20">
        <h2 class="logo txt-c mb-20">Micro Volt</h2>
        <ul>
            <li><a class="<?= $this->matchUrl('/') ? 'selected' : '' ?>" href="/" traget=""><i class="fa-solid fa-house"></i><span><?= $text_home ?></span></a></li>
            <li><a class="<?= $this->matchUrl('/transactions') ? 'selected' : '' ?>" href="/transactions" traget=""><i class="fa-solid fa-money-simple-from-bracket"></i><span><?= $text_transactions ?></span></a></li>
            <li><a class="<?= $this->matchUrl('/expenses') ? 'selected' : '' ?>" href="/expenses" traget=""><i class="fa-solid fa-magnifying-glass-dollar"></i><span><?= $text_expenses ?></span></a></li>
            <li>
                <a class="<?= $this->matchUrl('/store') ? 'selected' : '' ?>" href="/store" traget=""><i class="fa-solid fa-shop"></i><span><?= $text_store ?></span></a>
                <ul class="branch">
                    <li><a class="<?= $this->matchUrl('/productcategories') ? 'selected' : '' ?>" href="/productcategories" traget=""><span><?= $text_store_categories ?></span></a></li>
                    <li><a class="<?= $this->matchUrl('/productlist') ? 'selected' : '' ?>" href="/productlist" traget=""><span><?= $text_store_products ?></span></a></li>
                </ul>
            </li>
            <li><a class="<?= $this->matchUrl('/clients') ? 'selected' : '' ?>" href="/clients" traget=""><i class="fa-solid fa-users"></i><span><?= $text_clients ?></span></a></li>
            <li><a class="<?= $this->matchUrl('/suppliers') ? 'selected' : '' ?>" href="/suppliers" traget=""><i class="fa-solid fa-boxes-packing"></i><span><?= $text_suppliers ?></span></a></li>
            <li>
                <a  class="<?= $this->matchUrl('/users') ? 'selected' : '' ?>" href="/users" traget=""><i class="fa-solid fa-user"></i><span><?= $text_users ?></span></a>
                <ul class="branch">
                    <li><a class="<?= $this->matchUrl('/usersgroups') ? 'selected' : '' ?>" href="/usersgroups" traget=""><span><?= $text_users_groups ?></span></a></li>
                    <li><a class="<?= $this->matchUrl('/privileges') ? 'selected' : '' ?>" href="/privileges" traget=""><span><?= $text_users_privileges ?></span></a></li>
                </ul>
            </li>
            <li><a class="<?= $this->matchUrl('/reports') ? 'selected' : '' ?>" href="/reports" traget=""><i class="fa-solid fa-file-chart-pie"></i><span><?= $text_reports ?></span></a></li>
            <li><a class="<?= $this->matchUrl('/auth/logout') ? 'selected' : '' ?>" href="/auth/logout" traget=""><i class="fa-solid fa-right-from-bracket"></i><span><?= $text_logout ?></span></a></li>
        </ul>
    </div>