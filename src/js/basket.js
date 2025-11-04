const hasGiosg = () => typeof _giosg !== "undefined";
const formatPrice = (i, s) => [s.slice(0, i), s.slice(i)];
const stripHtml = (v) => {
  const div = document.createElement("div");
  div.innerHTML = v;
  return div.textContent;
};
let totalPrice = 0;
const handleCart = () => {
  const cartData = wp.data.select("wc/store/cart").getCartData();
  const currentTotal = cartData?.totals.total_price;
  const decimals = cartData.totals.currency_minor_unit;
  if (totalPrice !== currentTotal) {
    totalPrice = currentTotal;
    giosg.api.shoppingCart.setCurrency(cartData.totals.currency_code);
    if (cartData.coupons.length) {
      const subTotal = cartData.totals.total_price.toString();
      const subTotalLen = subTotal.length;
      const price = formatPrice(subTotalLen - decimals, subTotal);
      giosg.api.shoppingCart.setTotalPrice(price);
    }
    const items = cartData.items.map((item) => ({
      name: item.name,
      price: formatPrice(
        item.prices.price.toString().length - decimals,
        item.prices.price.toString(),
      ),
      quantity: item.quantity,
      description: stripHtml(item.description),
      product_number: item.sku || item.id,
    }));
    if (items.length) {
      giosg.api.shoppingCart.submit(items).then((e) => {});
    } else {
      giosg.api.shoppingCart.clearCart();
    }
  }
};
jQuery(document).ready(async ($) => {
  // Handle non block events.
  if (!wp.data && hasGiosg()) {
    const updateCart = () => {
      $.ajax({
        method: "POST",
        dataType: "json",
        url: wp_giosg.ajax_url,
        data: wp_giosg.data,
        success: (data) => {
          if (data.coupons.length) {
            giosg.api.shoppingCart.setTotalPrice(
              data.subtotal - data.discount_total,
            );
          }
          if (data.items.length) {
            giosg.api.shoppingCart.submit(data.items).then(() => {});
          } else {
            giosg.api.shoppingCart.clearCart().then(() => {});
          }
        },
      });
    };
    updateCart();
    $(document.body).on("added_to_cart updated_wc_div", (e) => {
      updateCart();
    });
  }
  if (hasGiosg() && wp.data) {
    wp.data.subscribe(() => {
      if (wp.data.select("wc/store/checkout").isComplete()) {
        giosg.api.shoppingCart.freeze().then(() => {});
      }
    }, "wc/store/checkout");
  }
  if (hasGiosg() && wp.data) {
    totalPrice = wp.data.select("wc/store/cart").getCartData()
      ?.totals?.total_price;
    handleCart();
    wp.data.subscribe(() => {
      handleCart();
    }, "wc/store/cart");
  }
});
