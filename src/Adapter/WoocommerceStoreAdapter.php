<?php

namespace WPGiosg\Adapter;

use WPGiosg\Interfaces\StoreInterface;

class WoocommerceStoreAdapter implements StoreInterface
{
    public function getCurrencies(): array
    {
        return get_woocommerce_currencies();
    }

    public function getCurrency(): string
    {
        return get_woocommerce_currency();
    }

    public function getCartItems(): array
    {
        $items = [];
        $coupons = [];
        foreach (WC()->cart->get_cart() as $item) {
            $items[] = [
                'name' => $item['data']->get_title(),
                'quantity' => $item['quantity'],
                'price' => $item['data']->get_price(),
            ];
        }
        foreach (WC()->cart->get_coupons() as $coupon) {
            $coupons[] = [
                'name' => $coupon->get_code(),
                'type' => $coupon->get_discount_type(),
                'amount' => $coupon->get_amount(),
            ];
            $items[] = [
                'name' => $coupon->get_code(),
                'quantity' => 1,
                'price' => 0,
            ];
        }
        return [
            'items' => $items,
            'coupons' => $coupons,
            'cart_subtotal' => WC()->cart->get_cart_subtotal(),
            'total' => WC()->cart->get_total(),
            'discount_subtotal' => WC()->cart->get_displayed_subtotal(),
            'discount_total' => WC()->cart->get_discount_total(),
            'cart_total' => WC()->cart->get_cart_total(),
            'cart_discount_total' => WC()->cart->get_cart_discount_total(),
            'displayed_subtotal' => WC()->cart->get_displayed_subtotal(),
            'subtotal' => WC()->cart->get_subtotal(),
            'total_discount' => WC()->cart->get_total_discount(),
        ];
    }
}
