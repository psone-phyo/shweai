<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-lg-down-none">
        <svg class="c-sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
            <use xlink:href="{{ asset('img/brand/coreui.svg#full') }}"></use>
        </svg>
        <svg class="c-sidebar-brand-minimized" width="46" height="46" alt="CoreUI Logo">
            <use xlink:href="{{ asset('img/brand/coreui.svg#signet') }}"></use>
        </svg>
    </div><!--c-sidebar-brand-->

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <x-utils.link
                class="c-sidebar-nav-link"
                :href="route('admin.dashboard')"
                :active="activeClass(Route::is('admin.dashboard'), 'c-active')"
                icon="c-sidebar-nav-icon cil-speedometer"
                :text="__('Dashboard')" />
        </li>
        @if (
            $logged_in_user->hasAllAccess() ||
            (
                $logged_in_user->can('admin.access.user.list') ||
                $logged_in_user->can('admin.access.user.deactivate') ||
                $logged_in_user->can('admin.access.user.reactivate') ||
                $logged_in_user->can('admin.access.user.clear-session') ||
                $logged_in_user->can('admin.access.user.impersonate') ||
                $logged_in_user->can('admin.access.user.change-password')
            )
        )
            <li class="c-sidebar-nav-title">@lang('System')</li>

            <li class="c-sidebar-nav-dropdown {{ activeClass(Route::is('admin.auth.user.*') || Route::is('admin.auth.role.*'), 'c-open c-show') }}">
                <x-utils.link
                    href="#"
                    icon="c-sidebar-nav-icon cil-user"
                    class="c-sidebar-nav-dropdown-toggle"
                    :text="__('Access')" />

                <ul class="c-sidebar-nav-dropdown-items">
                    @if (
                        $logged_in_user->hasAllAccess() ||
                        (
                            $logged_in_user->can('admin.access.user.list') ||
                            $logged_in_user->can('admin.access.user.deactivate') ||
                            $logged_in_user->can('admin.access.user.reactivate') ||
                            $logged_in_user->can('admin.access.user.clear-session') ||
                            $logged_in_user->can('admin.access.user.impersonate') ||
                            $logged_in_user->can('admin.access.user.change-password')
                        )
                    )
                        <li class="c-sidebar-nav-item">
                            <x-utils.link
                                :href="route('admin.auth.user.index')"
                                class="c-sidebar-nav-link"
                                :text="__('User Management')"
                                :active="activeClass(Route::is('admin.auth.user.*'), 'c-active')" />
                        </li>
                    @endif

                    @if ($logged_in_user->hasAllAccess())
                        <li class="c-sidebar-nav-item">
                            <x-utils.link
                                :href="route('admin.auth.role.index')"
                                class="c-sidebar-nav-link"
                                :text="__('Role Management')"
                                :active="activeClass(Route::is('admin.auth.role.*'), 'c-active')" />
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if ($logged_in_user->hasAllAccess())
            <li class="c-sidebar-nav-dropdown">
                <x-utils.link
                    href="#"
                    icon="c-sidebar-nav-icon cil-list"
                    class="c-sidebar-nav-dropdown-toggle"
                    :text="__('Logs')" />

                <ul class="c-sidebar-nav-dropdown-items">
                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('log-viewer::dashboard')"
                            class="c-sidebar-nav-link"
                            :text="__('Dashboard')" />
                    </li>
                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('log-viewer::logs.list')"
                            class="c-sidebar-nav-link"
                            :text="__('Logs')" />
                    </li>
                </ul>
            </li>
        @endif

        <li class="c-sidebar-nav-title">@lang('General')</li>
        @foreach(Module::group(1) as $module)
        <?php
            $module = $module->getLowerName();
            $route = "admin.$module.index";
            $active = "admin/$module*";
            $icon = config("$module.icon");
            $mod_trans = $module.'::menus.backend.sidebar.'.$module;
        ?>
        @if ($module === 'merchant')
        @if ($logged_in_user->hasAllAccess() || $logged_in_user->can("manage $module"))
        <li class="c-sidebar-nav-dropdown {{ activeClass(Request::is('admin/merchant*'), 'c-open c-show') }}">
            <x-utils.link
                href="#"
                icon="{{ $icon }}"
                class="c-sidebar-nav-dropdown-toggle"
                :text="__($mod_trans)" />

            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <x-utils.link
                        :href="route('admin.merchant.index')"
                        :icon="'c-sidebar-nav-icon fas fa-user-check'"
                        class="c-sidebar-nav-link"
                        :text="__('merchant::menus.backend.sidebar.approved')"
                        :active="activeClass(Route::is('admin.merchant.index'), 'c-active')"/>
                </li>
                <li class="c-sidebar-nav-item">
                    <x-utils.link
                        :href="route('admin.merchant.pending_list')"
                        class="c-sidebar-nav-link"
                        :icon="'c-sidebar-nav-icon fas fa-user-clock'"
                        :text="__('merchant::menus.backend.sidebar.pending')"
                        :active="activeClass(Route::is('admin.merchant.pending_list'), 'c-active')"/>
                </li>
                <li class="c-sidebar-nav-item">
                    <x-utils.link
                        :href="route('admin.merchant.rejected_list')"
                        class="c-sidebar-nav-link"
                        :icon="'c-sidebar-nav-icon fas fa-user-slash'"
                        :text="__('merchant::menus.backend.sidebar.rejected')"
                        :active="activeClass(Route::is('admin.merchant.rejected_list'), 'c-active')"/>
                </li>
                <li class="c-sidebar-nav-item">
                    <x-utils.link
                        :href="route('admin.merchant.suspended_list')"
                        class="c-sidebar-nav-link"
                        :icon="'c-sidebar-nav-icon fas fa-user-minus'"
                        :text="__('merchant::menus.backend.sidebar.suspended')"
                        :active="activeClass(Route::is('admin.merchant.suspended_list'), 'c-active')"/>
                </li>
            </ul>
        </li>
        @endif
        @else
        <li class="c-sidebar-nav-item">
            <x-utils.link
                class="c-sidebar-nav-link"
                :href="route($route)"
                :active="activeClass(Route::is($active), 'c-active')"
                icon="{{ $icon }}"
                :text="__($mod_trans)" />
        </li>
        @endif
        @endforeach

        @if (
            $logged_in_user->hasAllAccess() ||
                ($logged_in_user->can('admin.access.city.manage') ||
                    $logged_in_user->can('admin.access.township.manage')))
            <li
                class="c-sidebar-nav-dropdown {{ activeClass(Route::is('admin.region.*') || Route::is('admin.township.*'), 'c-open c-show') }}">
                <x-utils.link href="#" icon="c-sidebar-nav-icon fas fa-map" class="c-sidebar-nav-dropdown-toggle"
                    :text="__('Locations')" />
                @foreach (Module::group(2) as $module)
                    <?php
                    $module = $module->getLowerName();
                    $route = 'admin.' . $module . '.index';
                    $active = 'admin.' . $module . '.*';
                    $mod_trans = $module . '::menus.backend.sidebar.' . $module;
                    $permissionName = 'admin.access.' . $module;
                    $icon = config("$module.icon");
                    ?>
                    <ul class="c-sidebar-nav-dropdown-items">
                        @if (
                            $logged_in_user->hasAllAccess() ||
                                ($logged_in_user->can($permissionName) || $logged_in_user->can('admin.access.' . $module . '.manage')))
                            <li class="c-sidebar-nav-item">
                                <x-utils.link :href="route($route)" class="c-sidebar-nav-link" :icon="$icon"
                                    :text="__($mod_trans)"
                                    :active="activeClass(Route::is($active), 'c-active')" />
                            </li>
                        @endif

                    </ul>
                @endforeach
            </li>
        @endif
    </ul>

    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
</div><!--sidebar-->
