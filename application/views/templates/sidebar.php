    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">

        <img src="<?= base_url('assets/img/logo/icon-logo.png'); ?>" width="20%">
        <div class="sidebar-brand-text mx-3">I-Kept</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- QUERY MENU -->
      <?php
      $role_id = $this->session->userdata('role_id');
      $queryMenu = "
        SELECT `user_menu`.`id`, `menu`
        FROM `user_menu` JOIN `user_access_menu`
        ON `user_menu`.`id` = `user_access_menu`.`menu_id`
        WHERE `user_access_menu`.`role_id` = $role_id
        ORDER BY `user_access_menu`.`menu_id` ASC
        ";
      $menu = $this->db->query($queryMenu)->result_array();
      ?>

      <!-- LOOPING MENU -->
      <?php $i = 0; ?>
      <?php foreach ($menu as $m) : ?>
        <?php $i++; ?>

        <li class="nav-item <?php
                            if ($judul == $m['menu']) {
                              echo 'active';
                            } else {
                              echo '';
                            }
                            ?>">
          <!--Ini yang lama <a style="width: 100%;" href="" class="nav-link pb-0" data-toggle="collapse" data-target="#navbar<?= $i; ?>" aria-controls="navbar<?= $i; ?>" aria-expanded="false" aria-label="Toggle navigation"> -->
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse<?= $i; ?>" aria-expanded="true" aria-controls="collapse<?= $i; ?>">
            <span><?= $m['menu']; ?></span>
          </a>

          <!-- SIAPKAN SUB-MENU SESEUAI MENU -->
          <?php
          $menuId = $m['id'];
          $querySubMenu = "
                        SELECT *
                        FROM `user_sub_menu`
                        WHERE `menu_id` = $menuId
                        AND `is_active` = 1
                        ";
          $subMenu = $this->db->query($querySubMenu)->result_array();
          ?>
          <!-- <div class="collapse p-4" id="navbar<?= $i; ?>"> -->
          <div id="collapse<?= $i; ?>" class="collapse <?php
                                                        if ($judul == $m['menu']) {
                                                          echo 'show';
                                                        } else {
                                                          echo '';
                                                        }
                                                        ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">

              <?php foreach ($subMenu as $sm) : ?>

                <a class="collapse-item <?php
                                        if ($title == $sm['title']) {
                                          echo 'active';
                                        } else {
                                          echo '';
                                        }
                                        ?>" href="<?= base_url($sm['url']); ?>">
                  <i class="<?= $sm['icon']; ?>"></i>
                  <span><?= $sm['title']; ?></span></a>

              <?php endforeach; ?>

            </div>
          </div>
        </li>
        <!-- Divider -->
        <!-- <hr class="sidebar-divider mt-3"> -->
      <?php endforeach; ?>



      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('auth/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
          <i class="fas fa-sign-out-alt"></i>
          <span>Logout</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->