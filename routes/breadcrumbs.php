<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('public.home'));
});

// Home > create
Breadcrumbs::for('venta', function ($trail) {
    $trail->parent('home');
    $trail->push('Nueva venta', route('sells.create'));
});

// Home > Sells
Breadcrumbs::for('sells', function ($trail) {
    $trail->parent('home');
    $trail->push('Ventas', route('public.home.sells'));
});

// Home > Sells > Details
Breadcrumbs::for('detalles', function ($trail, $sells) {
    $trail->parent('sells');
    $trail->push('Venta #'. $sells->id, route('sells.details', $sells->id));
});

// Home > Caja
Breadcrumbs::for('caja', function ($trail) {
    $trail->parent('home');
    $trail->push('Caja', route('caja.index'));
});

// Home > Caja > Historial
Breadcrumbs::for('historial', function ($trail) {
    $trail->parent('caja');
    $trail->push('Historial', route('caja.history'));
});

// Home > Caja > Historial > id
Breadcrumbs::for('historyone', function ($trail, $id) {
    $trail->parent('historial');
    $trail->push('historial #'.$id, route('caja.historyone', $id));
});

// Home > Producto
Breadcrumbs::for('producto', function ($trail) {
    $trail->parent('home');
    $trail->push('Producto', route('producto.index'));
});

// Home > Categoria
Breadcrumbs::for('categoria', function ($trail) {
    $trail->parent('home');
    $trail->push('Categoría', route('categorias.index'));
});

// Home > Cliente
Breadcrumbs::for('cliente', function ($trail) {
    $trail->parent('home');
    $trail->push('Cliente', route('clientes.index'));
});

// Home > Proveedor
Breadcrumbs::for('proveedor', function ($trail) {
    $trail->parent('home');
    $trail->push('Proveedor', route('proveedor.index'));
});

// Home > Inventario
Breadcrumbs::for('inventario', function ($trail) {
    $trail->parent('home');
    $trail->push('Inventario', route('inventario.index'));
});

// Home > Inventario > History
Breadcrumbs::for('history', function ($trail, $slug) {
    $trail->parent('inventario');
    $trail->push('Historial: '. $slug, route('inventario.history', $slug));
});

// Home > Abastecer
Breadcrumbs::for('abastecer', function ($trail) {
    $trail->parent('home');
    $trail->push('Abastecer', route('abastecerinv'));
});

// Home > Reabastecer
Breadcrumbs::for('reabastecer', function ($trail) {
    $trail->parent('home');
    $trail->push('Reabastecimientos', route('reabastecerinv'));
});

// Home > RepProduct
Breadcrumbs::for('rep_product', function ($trail) {
    $trail->parent('home');
    $trail->push('Reporte Producto', route('sells.product'));
});

// Home > RepCat
Breadcrumbs::for('rep_categoria', function ($trail) {
    $trail->parent('home');
    $trail->push('Reporte Categoría', route('sells.category'));
});

// Home > RepVent
Breadcrumbs::for('rep_venta', function ($trail) {
    $trail->parent('home');
    $trail->push('Reporte Venta', route('sells.sells'));
});

// Home > RepComp
Breadcrumbs::for('rep_compra', function ($trail) {
    $trail->parent('home');
    $trail->push('Reporte Compra', route('sells.buys'));
});