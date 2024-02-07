<?php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('Dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('admin.dashboard'));
});

// Home > Blog
Breadcrumbs::for('categories.index', function (BreadcrumbTrail $trail) {
    $trail->parent('Dashboard');
    $trail->push('Category', route('categories.index'));
});

Breadcrumbs::for('products.index', function (BreadcrumbTrail $trail) {
    $trail->parent('Dashboard');
    $trail->push('Product', route('products.index'));
});

Breadcrumbs::for('categories.create', function (BreadcrumbTrail $trail) {
    $trail->parent('Dashboard');
    $trail->push('Category', route('categories.create'));
});

Breadcrumbs::for('products.create', function (BreadcrumbTrail $trail) {
    $trail->parent('Dashboard');
    $trail->push('Product', route('products.create'));
});

// Home > Blog > [Category]
Breadcrumbs::for('categories.show', function (BreadcrumbTrail $trail, $show) {
    $trail->parent('categories.index');
    $trail->push('Detail', route('categories.show', $show));
});
Breadcrumbs::for('products.show', function (BreadcrumbTrail $trail, $show) {
    $trail->parent('products.index');
    $trail->push('Detail', route('products.show', $show));
});

Breadcrumbs::for('categories.edit', function (BreadcrumbTrail $trail, $edit) {
    $trail->parent('categories.index');
    $trail->push('Edit', route('categories.edit', $edit));
});
Breadcrumbs::for('products.edit', function (BreadcrumbTrail $trail, $edit) {
    $trail->parent('products.index');
    $trail->push('Edit', route('products.edit', $edit));
});
