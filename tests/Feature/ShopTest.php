<?php

namespace Tests\Feature;

use Database\Seeders\ProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShopTest extends TestCase
{
    use RefreshDatabase;

    public function test_paginas_publicas_cargan(): void
    {
        $this->seed(ProductSeeder::class);
        foreach (['/', '/catalogo', '/catalogo/odyssey-clasica', '/carrito', '/nosotros', '/contacto'] as $url) {
            $this->get($url)->assertOk();
        }
    }

    public function test_agregar_al_carrito_y_hacer_pedido(): void
    {
        $this->seed(ProductSeeder::class);
        $this->post('/carrito/odyssey-clasica', ['size' => '8 pies', 'color' => 'Verde torneo',
            'surface' => 'Pizarra', 'qty' => 1])->assertRedirect();
        $this->post('/pedido', ['name' => 'Ana', 'email' => 'ana@mail.com', 'phone' => '5512345678',
            'address' => 'Calle 1', 'city' => 'CDMX'])->assertRedirect();
        $this->assertDatabaseCount('orders', 1);
    }

    public function test_contacto_guarda_mensaje(): void
    {
        $this->post('/contacto', ['name' => 'Ana', 'email' => 'ana@mail.com', 'message' => 'Hola'])
            ->assertSessionHas('sent');
        $this->assertDatabaseCount('contact_messages', 1);
    }
}
