<?php
namespace App\Http\Controllers;
use App\Models\{Product, Order, ContactMessage};
use App\Support\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller {
    public function home() { return view('tienda.inicio', ['featured' => Product::limit(3)->get()]); }

    public function catalog(Request $r) {
        $badge = $r->query('badge');
        $products = Product::when($badge, fn ($q) => $q->where('badge', $badge))->get();
        return view('tienda.catalogo', compact('products', 'badge'));
    }

    public function show(Product $product) { return view('tienda.producto', compact('product')); }

    public function cart() { return view('tienda.carrito', ['lines' => Cart::lines(), 'total' => Cart::total()]); }

    public function cartAdd(Request $r, Product $product) {
        $d = $r->validate([
            'size' => ['required', 'in:' . implode(',', array_column($product->sizes, 'label'))],
            'color' => ['required', 'in:' . implode(',', array_column($product->colors, 'name'))],
            'surface' => ['required', 'in:' . implode(',', $product->surfaces)],
            'qty' => ['required', 'integer', 'min:1', 'max:10'],
        ]);
        Cart::add($product, $d['size'], $d['color'], $d['surface'], (int) $d['qty']);
        return back()->with('added', $product->name);
    }

    public function cartUpdate(Request $r, string $key) {
        Cart::update($key, (int) $r->input('qty', 1));
        return back();
    }

    public function cartRemove(string $key) { Cart::remove($key); return back(); }

    public function checkout() {
        if (! Cart::count()) return redirect()->route('cart');
        return view('tienda.pedido', ['lines' => Cart::lines(), 'total' => Cart::total()]);
    }

    public function orderStore(Request $r) {
        if (! Cart::count()) return redirect()->route('cart');
        $d = $r->validate([
            'name' => 'required|string|max:120', 'email' => 'required|email|max:150',
            'phone' => ['required', 'regex:/^[0-9 +()-]{8,20}$/'],
            'address' => 'required|string|max:200', 'city' => 'required|string|max:100',
            'notes' => 'nullable|string|max:500',
        ]);
        $order = DB::transaction(function () use ($d, $r) {
            $order = Order::create($d + [
                'number' => 'ODY-' . str_pad((string) random_int(0, 99999), 5, '0', STR_PAD_LEFT),
                'user_id' => $r->user()?->id, 'total' => Cart::total()]);
            foreach (Cart::lines() as $l) {
                $order->items()->create(['product_id' => $l['product_id'], 'name' => $l['product']->name,
                    'size' => $l['size'], 'color' => $l['color'], 'surface' => $l['surface'],
                    'unit_price' => $l['unit_price'], 'qty' => $l['qty']]);
            }
            return $order;
        });
        Cart::clear();
        session(['last_order' => $order->number]);
        return redirect()->route('order.done', $order);
    }

    public function orderDone(Order $order) {
        abort_unless(session('last_order') === $order->number, 404);
        return view('tienda.confirmacion', ['order' => $order->load('items')]);
    }

    public function about() { return view('tienda.nosotros'); }
    public function contact() { return view('tienda.contacto'); }

    public function contactStore(Request $r) {
        ContactMessage::create($r->validate([
            'name' => 'required|string|max:120', 'email' => 'required|email|max:150',
            'subject' => 'nullable|string|max:150', 'message' => 'required|string|max:2000']));
        return back()->with('sent', true);
    }
}
