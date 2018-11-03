<?php

use Spatie\Menu\Laravel\Menu;
use Spatie\Menu\Laravel\Html;
use Spatie\Menu\Laravel\Link;

Menu::macro('adminlteMenu', function () {
    return Menu::new()
       ->addClass('nav nav-pills nav-sidebar flex-column')->setAttribute('data-widget', 'treeview')
       ->setAttribute('role', 'menu')
       ->setAttribute('data-accordion', 'false');
});

Menu::macro('adminlteSubmenu', function ($submenuName) {
    return Menu::new()->prepend('<a href="#" class="nav-link"><i class="nav-icon fa fa-database"></i><p> ' . $submenuName . '<i class="right fa fa-angle-left"></i></p></a>')
        ->addParentClass('nav-item has-treeview')->addClass('nav nav-treeview');
});
Menu::macro('adminSubmenuInv', function ($submenuName) {
    return Menu::new()->prepend('<a href="#" class="nav-link"><i class="nav-icon fas fa-chart-area"></i><p> ' . $submenuName . '<i class="right fa fa-angle-left"></i></p></a>')
        ->addParentClass('nav-item has-treeview')->addClass('nav nav-treeview');
});
Menu::macro('SubmenuAdmin', function ($submenuName) {
    return Menu::new()->prepend('<a href="#" class="nav-link active"><i class="nav-icon fa fa-user-secret"></i><p> ' . $submenuName . '<i class="right fa fa-angle-left"></i></p></a>')
        ->addParentClass('nav-item has-treeview')->addClass('nav nav-treeview');
});

Menu::macro('adminlteSeparator', function ($title) {
    return Html::raw($title)->addParentClass('header');
});

Menu::macro('adminlteDefaultMenu', function ($content) {
    return Html::raw('<i class="fa fa-link"></i><span>' . $content . '</span>')->html();
});

Menu::macro('sidebar', function () {
    return Menu::adminlteMenu()
    ->setActiveClass('menu-open active')
        ->setActiveClassOnLink()
        ->add(Link::toUrl('/home', '<i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard</p>')->addClass('nav-link')->addParentClass('nav-item'))
        ->add(Link::toUrl('/create', '<i class="nav-icon fa fa-cart-arrow-down"></i><p>Vender</p>')->addClass('nav-link')->addParentClass('nav-item'))
        ->add(Link::toUrl('/sells', '<i class="nav-icon fa fa-shopping-cart"></i><p>Ventas</p>')->addClass('nav-link')->addParentClass('nav-item'))
        ->add(Link::toUrl('/caja', '<i class="nav-icon fa fa-cube"></i><p>Caja</p>')->addClass('nav-link')->addParentClass('nav-item'))

        ->add(
           Menu::adminlteSubmenu('Catalogo')
           ->setActiveClassOnLink()
                ->add(Link::toUrl('/producto', '<i class="fab fa-product-hunt nav-icon"></i><p>Producto</p>')->addClass('nav-link')->addParentClass('nav-item'))
                ->add(Link::toUrl('/categorias', '<i class="fa fa-list nav-icon"></i><p>Categorías</p>')->addClass('nav-link')->addParentClass('nav-item'))
                ->add(Link::toUrl('/clientes', '<i class="fa fa-users nav-icon"></i><p>Clientes</p>')->addClass('nav-link')->addParentClass('nav-item'))
                ->add(Link::toUrl('/proveedor', '<i class="fa fa-list nav-icon"></i><p>Proveedores</p>')->addClass('nav-link')->addParentClass('nav-item'))
       )

        ->add(
           Menu::adminSubmenuInv('Inventario')
           ->setActiveClassOnLink()
                ->add(Link::toUrl('/inventario', '<i class="fa fa-list-alt nav-icon"></i><p>Inventario</p>')->addClass('nav-link')->addParentClass('nav-item'))
                ->add(Link::toUrl('/abastecer', '<i class="fas fa-sync-alt nav-icon"></i><p>Abastecer</p>')->addClass('nav-link')->addParentClass('nav-item'))
                ->add(Link::toUrl('/abastecimientos', '<i class="fa fa-history nav-icon"></i><p>Abastecimientos</p>')->addClass('nav-link')->addParentClass('nav-item'))
                ->add(Link::toUrl('/inventotal', '<i class="fas fa-dollar-sign  nav-icon"></i><p>Inventario Total <span class="right badge badge-danger">Beta</span></p>')->addClass('nav-link')->addParentClass('nav-item'))
        )->setActiveFromRequest();
       
});

Menu::macro('sidebarAdmin', function () {
    return Menu::adminlteMenu()
    ->setActiveClass('menu-open active')
        ->add(
        Menu::new()
        ->setActiveClassOnLink()
        ->prepend(Link::to('#','<i class="nav-icon fas fa-file-invoice"></i><p>Reportes<i class="right fa fa-angle-left"></i></p></a>')->addClass('nav-link'))
        ->addParentClass('nav-item has-treeview')->addClass('nav nav-treeview')
            ->add(Link::toUrl('/reporte/products', '<i class="fas fa-chart-line nav-icon"></i><p>Por producto</p>')->addClass('nav-link')->addParentClass('nav-item'))
            ->add(Link::toUrl('/reporte/categorias', '<i class="fas fa-th-list nav-icon"></i><p>Por categoría</p>')->addClass('nav-link')->addParentClass('nav-item'))
            ->add(Link::toUrl('/reporte/sells', '<i class="fas fa-list nav-icon"></i><p>Ventas</p>')->addClass('nav-link')->addParentClass('nav-item'))
            ->add(Link::toUrl('/reporte/buys', '<i class="fas fa-list nav-icon"></i><p>Compas</p>')->addClass('nav-link')->addParentClass('nav-item'))
       )
       ->add(
        Menu::new()
        ->setActiveClassOnLink()
        ->prepend(Link::to('#','<i class="nav-icon fas fa-cogs"></i><p>Configuración<i class="right fa fa-angle-left"></i></p></a>')->addClass('nav-link'))
        ->addParentClass('nav-item has-treeview')->addClass('nav nav-treeview')
            ->add(Link::toUrl('/routes', '<i class="fa fa-list-alt nav-icon"></i><p>Routes</p>')->addClass('nav-link')->addParentClass('nav-item'))
            ->add(Link::toUrl('/config', '<i class="fas fa-cog nav-icon"></i><p>Configurar</p>')->addClass('nav-link')->addParentClass('nav-item'))
            ->add(Link::toUrl('/users', '<i class="fas fa-users-cog nav-icon"></i><p>Usuarios</p>')->addClass('nav-link')->addParentClass('nav-item'))
       )->setActiveFromRequest();
});
