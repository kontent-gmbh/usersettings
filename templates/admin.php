<?php
script('usersettings', 'settings');
?>
<form id="usersettings_form" class="section">
    <h2><?php p($l->t('User Security Settings')); ?></h2><span id="usersettings_msg" class="msg"></span>
    <p class="setting-hint">
        <?php p($l->t('Configure the default visibility settings for the new users.')) ?>
    </p>
    <p>
        <label for="name_visibility"><?php p($l->t('Visibility for the displayname')); ?></label>
        <select id="name_visibility" name="name_visibility">
            <?php
            foreach ($_['scopes'] as $key => $value)
            {
                $selected = $_['name_v'] === $key ? 'selected="selected"' : '';
                echo '<option value="' . $key . '" ' . $selected . '>' . $value . '</option>';
            }
            ?>
        </select>
    </p>
    <p>
        <label for="address_visibility"><?php p($l->t('Visibility for the address')); ?></label>
        <select id="address_visibility" name="address_visibility">
            <?php
            foreach ($_['scopes'] as $key => $value)
            {
                $selected = $_['address_v'] === $key ? 'selected="selected"' : '';
                echo '<option value="' . $key . '" ' . $selected . '>' . $value . '</option>';
            }
            ?>
        </select>
    </p>
    <p>
        <label for="site_visibility"><?php p($l->t('Visibility for the website')); ?></label>
        <select id="site_visibility" name="site_visibility">
            <?php
            foreach ($_['scopes'] as $key => $value)
            {
                $selected = $_['site_v'] === $key ? 'selected="selected"' : '';
                echo '<option value="' . $key . '" ' . $selected . '>' . $value . '</option>';
            }
            ?>
        </select>
    </p>
    <p>
        <label for="email_visibility"><?php p($l->t('Visibility for the email address')); ?></label>
        <select id="email_visibility" name="email_visibility">
            <?php
            foreach ($_['scopes'] as $key => $value)
            {
                $selected = $_['email_v'] === $key ? 'selected="selected"' : '';
                echo '<option value="' . $key . '" ' . $selected . '>' . $value . '</option>';
            }
            ?>
        </select>
    </p>
    <p>
        <label for="avatar_visibility"><?php p($l->t('Visibility for the avatar')); ?></label>
        <select id="avatar_visibility" name="avatar_visibility">
            <?php
            foreach ($_['scopes'] as $key => $value)
            {
                $selected = $_['avatar_v'] === $key ? 'selected="selected"' : '';
                echo '<option value="' . $key . '" ' . $selected . '>' . $value . '</option>';
            }
            ?>
        </select>
    </p>
    <p>
        <label for="phone_visibility"><?php p($l->t('Visibility for the phonenumber')); ?></label>
        <select id="phone_visibility" name="phone_visibility">
            <?php
            foreach ($_['scopes'] as $key => $value)
            {
                $selected = $_['phone_v'] === $key ? 'selected="selected"' : '';
                echo '<option value="' . $key . '" ' . $selected . '>' . $value . '</option>';
            }
            ?>
        </select>
    </p>
    <p>
        <label for="twitter_visibility"><?php p($l->t('Visibility for the twitter account')); ?></label>
        <select id="twitter_visibility" name="twitter_visibility">
            <?php
            foreach ($_['scopes'] as $key => $value)
            {
                $selected = $_['twitter_v'] === $key ? 'selected="selected"' : '';
                echo '<option value="' . $key . '" ' . $selected . '>' . $value . '</option>';
            }
            ?>
        </select>
    </p>
</form>
