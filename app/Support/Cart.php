<?php
namespace App\Support;
use App\Models\Product;

/** Carrito guardado en sesión. El precio SIEMPRE se calcula en el servidor. */
class Cart {
    public static function raw(): array { return session('cart', []); }

    public static function add(Product $p, string $size, string $color, string $surface, int $qty): void {
        $extra = collect($p->sizes)->firstWhere('label', $size)['extra'] ?? 0;
        $key = md5("$p->id|$size|$color|$surface");
        $cart = self::raw();
        $qty += $cart[$key]['qty'] ?? 0;
        $cart[$key] = ['product_id' => $p->id, 'size' => $size, 'color' => $color,
            'surface' => $surface, 'qty' => min($qty, 10), 'unit_price' => $p->price + $extra];
        session(['cart' => $cart]);
    }
    public static function update(string $key, int $qty): void {
        $cart = self::raw();
        if (isset($cart[$key])) { $cart[$key]['qty'] = max(1, min($qty, 10)); session(['cart' => $cart]); }
    }
    public static function remove(string $key): void {
        $cart = self::raw(); unset($cart[$key]); session(['cart' => $cart]);
    }
    public static function clear(): void { session()->forget('cart'); }

    /** Líneas con el producto cargado y subtotal. */
    public static function lines(): array {
        $cart = self::raw();
        $products = Product::whereIn('id', array_column($cart, 'product_id'))->get()->keyBy('id');
        $out = [];
        foreach ($cart as $key => $l) {
            if (! isset($products[$l['product_id']])) continue;
            $out[$key] = $l + ['key' => $key, 'product' => $products[$l['product_id']],
                'subtotal' => $l['unit_price'] * $l['qty']];
        }
        return $out;
    }
    public static function total(): int { return array_sum(array_column(self::lines(), 'subtotal')); }
    public static function count(): int { return array_sum(array_column(self::raw(), 'qty')); }
}
