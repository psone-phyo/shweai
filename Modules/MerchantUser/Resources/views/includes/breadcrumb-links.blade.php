<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('merchantuser::menus.backend.merchantuser.main') }}</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item" href="{{ route('admin.merchantuser.index') }}">{{ __('merchantuser::menus.backend.merchantuser.all') }}</a>
                @can('admin.access.merchantuser.create')
                <a class="dropdown-item" href="{{ route('admin.merchantuser.create') }}">{{ __('merchantuser::menus.backend.merchantuser.create') }}</a>
                @endcan
            </div>
        </div><!--dropdown-->

        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>