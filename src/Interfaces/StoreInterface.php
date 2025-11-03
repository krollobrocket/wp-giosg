<?php

namespace WPGiosg\Interfaces;

interface StoreInterface
{
    public function getCurrencies(): array;
    public function getCurrency(): string;
    public function getCartItems(): array;
}
