<div class="wrap">
    <h1></h1>
    <form action="<?php echo admin_url('admin-post.php'); ?>" method="POST">
        <input type="hidden" name="action" value="wp_giosg_save_settings" />
        <?php echo wp_nonce_field('wp-giosg-settings-action', 'wp-giosg-settings-nonce'); ?>
        <table class="form-table">
            <tr>
                <th scope="row">
                    <label for="active"><?php _e('Enable chat', 'wp-giosg'); ?></label>
                    </th>
                <td>
                    <input type="checkbox" id="active" name="active"<?php checked($this->settings->get('active')); ?> />
                    <p class="description"><?php _e('Activate live chat.', 'wp-giosg'); ?></p>
                    </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="scriptVersion"><?php _e('Script version', 'wp-giosg'); ?></label>
                </th>
                <td>
                    <select id="scriptVersion" name="scriptVersion">
                        <option value="v1"<?php selected($this->settings->get('scriptVersion') === 'v1'); ?>><?php _e('v1', 'wp-giosg'); ?></option>
                        <option value="v2"<?php selected($this->settings->get('scriptVersion') === 'v2'); ?>><?php _e('v2', 'wp-giosg'); ?></option>
                    </select>
                    <p class="description"><?php _e('The version of the giosg script to use.', 'wp-giosg'); ?></p>
                </td>
            </tr>
            <tr>
            <tr>
                <th scope="row">
                    <label for="anonymously"><?php _e('Display chat for anonymous users', 'wp-giosg'); ?></label>
                    </th>
                <td>
                    <input type="checkbox" id="anonymously" name="anonymously"<?php checked($this->settings->get('anonymously')); ?> />
                    <p class="description"><?php _e('Enable chat for both anonymous and logged in users.', 'wp-giosg'); ?></p>
                    </td>
                </tr>
            <tr>
                <th scope="row">
                    <label for="companyID"><?php _e('Company ID', 'wp-giosg'); ?></label>
                    </th>
                <td>
                    <input type="text" id="companyID" name="companyID" class="regular-text" value="<?php echo $this->settings->get('companyID'); ?>" />
                    <p class="description"><?php _e('Giosg company ID.', 'wp-giosg'); ?></p>
                    </td>
            </tr>
          <tr>
            <th scope="row">
              <label for="companyUUID"><?php _e('Company UUID', 'wp-giosg'); ?></label>
            </th>
            <td>
              <input type="text" id="companyUUID" name="companyUUID" class="regular-text" value="<?php echo $this->settings->get('companyUUID'); ?>" />
              <p class="description"><?php _e('Giosg company UUID.', 'wp-giosg'); ?></p>
            </td>
          </tr>
          <tr>
            <th scope="row">
              <label for="roomId"><?php _e('Room ID', 'wp-giosg'); ?></label>
            </th>
            <td>
              <input type="text" id="roomId" name="roomId" class="regular-text" value="<?php echo $this->settings->get('roomId'); ?>" />
              <p class="description"><?php _e('Giosg room ID.', 'wp-giosg'); ?></p>
            </td>
          </tr>
          <tr>
            <th scope="row">
              <label for="accessToken"><?php _e('Access Token', 'wp-giosg'); ?></label>
            </th>
            <td>
              <input type="text" id="accessToken" name="accessToken" class="regular-text" value="<?php echo $this->settings->get('accessToken'); ?>" />
              <p class="description"><?php _e('Giosg Access Token.', 'wp-giosg'); ?></p>
            </td>
          </tr>
          <tr>
            <th scope="row">
              <label for="apiSigningKey"><?php _e('Api Signing Key', 'wp-giosg'); ?></label>
            </th>
            <td>
              <input type="text" id="apiSigningKey" name="apiSigningKey" class="regular-text" value="<?php echo $this->settings->get('apiSigningKey'); ?>" />
              <p class="description"><?php _e('Giosg API Signing Key.', 'wp-giosg'); ?></p>
            </td>
          </tr>
            <tr>
                <th scope="row">
                    <label for="enableBasket"><?php _e('Enable basket', 'wp-giosg'); ?></label>
                    </th>
                <td>
                    <input type="checkbox" id="enableBasket" name="enableBasket"<?php checked($this->settings->get('enableBasket')); ?><?php disabled(!is_plugin_active('woocommerce/woocommerce.php')); ?> />
                    <p class="description"><?php _e('Enable basket tracking.', 'wp-giosg'); ?></p>
                    <p class="description"><?php _e('You need to have WooCommerce enabled to use this feature.', 'wp-giosg'); ?></p>
                </td>
            </tr>
            <!--
            <tr>
                <th scope="row">
                    <label for="ecommerceType"><?php _e('E-Commerce', 'wp-giosg'); ?></label>
                </th>
                <td>
                    <select id="ecommerceType" name="ecommerceType">
                        <?php foreach ($this->getStores() as $key => $store) : ?>
                        <option value="<?php echo $key; ?>"><?php echo $store; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <p class="description"><?php _e('Type of e-commerce solution.', 'wp-giosg'); ?></p>
                </td>
            </tr>
            -->
        </table>
        <?php echo get_submit_button(__('Save settings', 'wp-giosg'), 'primary', 'wp-giosg-settings'); ?>
    </form>
</div>