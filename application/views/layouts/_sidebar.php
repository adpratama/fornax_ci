<div id="sidebar">
    <div class="sidebar-wrapper">
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>
                <?php
                $menu = $this->M_Setting->get_menus();
                $login_menu = $this->M_User->getUserMenu($this->session->userdata('username'));

                foreach ($menu as $m) :
                    $submenus = $this->M_Setting->get_submenus($m->Id);
                    $isActive = ($this->uri->segment(1) == $m->controller) ? 'active' : '';
                    $hasChildClass = ($m->has_child == '1') ? 'has-sub' : '';
                    // $url = explode('/', $m->url);

                    if (in_array($m->Id, json_decode($login_menu['access_menu'], true))) : ?>
                        <li class="sidebar-item <?= $hasChildClass ?> <?= $isActive ?>">
                            <a href="<?= base_url($m->url) ?>" class="sidebar-link">
                                <i class="bi <?= ($m->has_child == '1') ? 'bi-stack' : 'bi-grid-fill' ?>"></i>
                                <span><?= $m->nama_menu ?></span>
                            </a>
                            <?php if ($m->has_child == '1') : ?>
                                <ul class="submenu">
                                    <?php foreach ($submenus as $s) :
                                        if (in_array($s->Id, json_decode($login_menu['access_sub_menu'], true))) : ?>
                                            <li class="submenu-item <?= ($this->uri->uri_string() == $s->url) ? 'active' : '' ?>">
                                                <a href="<?= base_url($s->url) ?>" class="submenu-link">
                                                    <?= ($this->uri->uri_string() == $s->url) ? '<i class="bi bi-dash"></i>' : '' ?> <?= $s->nama_menu ?>
                                                </a>
                                            </li>
                                    <?php endif;
                                    endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </li>
                <?php endif;
                endforeach; ?>

                <li class="sidebar-item">
                    <a href="<?= base_url('auth/logout') ?>" class="sidebar-link btn-logout">
                        <i class="bi bi-grid-fill"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>