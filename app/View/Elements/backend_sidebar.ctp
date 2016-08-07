<aside>
    <div id="sidebar" class="nav-collapse">
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <?php if (AuthComponent::user('user_type') == 1): ?>
                    <?= $this->element('admin_side_menu') ?>
                <?php elseif(AuthComponent::user('user_type') == 3):?>
                  <?= $this->element('assistant_side_menu') ?>
                <?php elseif(AuthComponent::user('user_type') == 2 && $doctor_side_menu):?>
                  <?= $this->element('doctor_side_menu') ?>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</aside>
