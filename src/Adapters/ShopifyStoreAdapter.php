<?php

namespace WPGiosg\Adapters;

use WPGiosg\Interfaces\StoreInterface;

class ShopifyStoreAdapter implements StoreInterface
{
    public function getCurrencies(): array
    {
        // TODO: Implement getCurrencies() method.
        return [];
    }

    public function getCurrency(): string
    {
        // TODO: Implement getCurrency() method.
        return '';
    }

    public function getCartItems(): array
    {
        // TODO: Implement getCartItems() method.
        return [];
    }
}
