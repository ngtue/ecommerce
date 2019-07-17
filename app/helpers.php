<?php

function presentPrice ($price) {
    return sprintf('$ %1.2f', floatval($price)/100);
}

function setActiveCategory($category, $output = 'active') {
    return request()->category == $category ? $output : '';
}

function getCoupon(){
    $tax = config('cart.tax') / 100;
    $discount = session()->get('coupon')['discount'] ?? 0;
    $code = session()->get('coupon')['name'] ?? null;
    $newSubtotal = Cart::subtotal() - $discount;
    if($newSubtotal < 0) {
        $newSubtotal = 0;
    }
    $newTax = $newSubtotal * $tax;
    $newTotal = $newSubtotal * (1 + $tax);
    
    return collect([
        'tax' => $tax,
        'discount' => $discount,
        'code' => $code,
        'newSubtotal' => $newSubtotal,
        'newTax' => $newTax,
        'newTotal' => $newTotal,
    ]);
}