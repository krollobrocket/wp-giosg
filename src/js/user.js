jQuery(document).ready(async ($) => {
  _giosg(() => {
    if (wp_giosg.is_logged_in) {
      if (!localStorage.getItem("wp-giosg-user")) {
        localStorage.setItem("wp-giosg-user", {
          ...wp_giosg.user,
        });
        // username, avatar, __im_hidden_variable
        giosg.api.visitor.submit({
          username: wp_giosg.user.username,
          email: wp_giosg.user.email,
          avatar: wp_giosg.user.avatar,
        });
      }
    } else {
      if (localStorage.getItem("wp-giosg-user")) {
        localStorage.removeItem("wp-giosg-user");
        giosg.api.visitor.removeAll();
      }
    }
  });
});
