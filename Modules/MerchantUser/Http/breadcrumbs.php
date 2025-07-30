<?php

Breadcrumbs::for('admin.merchantuser.index', function ($trail) {
	$trail->push(__('Home'), route('admin.dashboard'));
    $trail->push(__('merchantuser::labels.backend.merchantuser.management'), route('admin.merchantuser.index'));
});

Breadcrumbs::for('admin.merchantuser.create', function ($trail) {
    $trail->parent('admin.merchantuser.index');
    $trail->push(__('merchantuser::labels.backend.merchantuser.create'), route('admin.merchantuser.create'));
});

Breadcrumbs::for('admin.merchantuser.show', function ($trail, $id) {
    $trail->parent('admin.merchantuser.index');
    $trail->push(__('merchantuser::labels.backend.merchantuser.show'), route('admin.merchantuser.show', $id));
});

Breadcrumbs::for('admin.merchantuser.edit', function ($trail, $id) {
    $trail->parent('admin.merchantuser.index');
    $trail->push(__('merchantuser::labels.backend.merchantuser.edit'), route('admin.merchantuser.edit', $id));
});
