<?php

Breadcrumbs::for('admin.merchant.index', function ($trail) {
	$trail->push(__('Home'), route('admin.dashboard'));
    $trail->push(__('merchant::labels.backend.merchant.management'), route('admin.merchant.index'));
});

Breadcrumbs::for('admin.merchant.create', function ($trail) {
    $trail->parent('admin.merchant.index');
    $trail->push(__('merchant::labels.backend.merchant.create'), route('admin.merchant.create'));
});

Breadcrumbs::for('admin.merchant.show', function ($trail, $id) {
    $trail->parent('admin.merchant.index');
    $trail->push(__('merchant::labels.backend.merchant.show'), route('admin.merchant.show', $id));
});

Breadcrumbs::for('admin.merchant.edit', function ($trail, $id) {
    $trail->parent('admin.merchant.index');
    $trail->push(__('merchant::labels.backend.merchant.edit'), route('admin.merchant.edit', $id));
});
