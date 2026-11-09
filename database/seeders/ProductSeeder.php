<?php
namespace Database\Seeders;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder {
    public function run(): void {
        $colors = [['name'=>'Verde torneo','hex'=>'#1f5a3a'],['name'=>'Azul medianoche','hex'=>'#1d3557'],
                   ['name'=>'Burdeos','hex'=>'#6b1d2a'],['name'=>'Gris grafito','hex'=>'#4a4f52']];
        $surfaces = ['Madera laminada', 'Pizarra'];
        $items = [
          ['Odyssey Clásica','odyssey-clasica','Mesa de 8 pies con estructura de nogal macizo y troneras de cuero. La que más se parece a una sala de billar de siempre.',58900,'Destacado','#2d4a36',[['7 pies',-9000],['8 pies',0],['9 pies',12000]]],
          ['Odyssey Torneo','odyssey-torneo','Medidas reglamentarias de 9 pies, pizarra de tres piezas nivelable y bandas de competencia.',89500,'Destacado','#3a3322',[['8 pies',-11000],['9 pies',0]]],
          ['Odyssey Compacta','odyssey-compacta','Pensada para casas y departamentos: 7 pies, patas desmontables y se arma en una tarde.',34900,'Nuevo','#22333a',[['6 pies',-5000],['7 pies',0]]],
          ['Odyssey Salón','odyssey-salon','Mesa convertible: con la tapa incluida sirve también de comedor para ocho personas.',72500,'Más vendido','#3a2228',[['7 pies',-8000],['8 pies',0],['9 pies',10000]]],
        ];
        foreach ($items as [$n,$s,$d,$p,$b,$tone,$sizes]) {
            Product::updateOrCreate(['slug'=>$s], [
                'name'=>$n,'description'=>$d,'price'=>$p,'badge'=>$b,'tone'=>$tone,
                'sizes'=>array_map(fn($x)=>['label'=>$x[0],'extra'=>$x[1]],$sizes),
                'colors'=>$colors,'surfaces'=>$surfaces]);
        }
    }
}
