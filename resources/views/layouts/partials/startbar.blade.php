<div class="startbar d-print-none">
    <!--start brand-->
    <div class="brand">
        <a href="{{ url('/dashboard') }}" class="logo">
            <!-- Logo Small -->
            <span>
                <img src="/images/logos/lang-logo/brolivinglogo.svg" alt="logo-small" class="logo-sm" height="30">
            </span>
            <!-- Logo Large -->
            <span class="">
                <!-- Light Mode -->
                <img src="/images/logos/lang-logo/brolivinglogo.svg" alt="logo" height="40" class="logo-lg logo-light">
                <img src="/images/logos/lang-logo/broliving.svg" alt="text" height="24" class="logo-lg logo-light ms-1">

                <!-- Dark Mode -->
                <img src="/images/logos/lang-logo/brolivinglogo.svg" alt="logo" height="40" class="logo-lg logo-dark">
                <img src="/images/logos/lang-logo/broliving.svg" alt="text" height="24" class="logo-lg logo-dark ms-1">
            </span>
        </a>
    </div>
    <!--end brand-->
    <!--start startbar-menu-->
    <div class="startbar-menu">
        <div class="startbar-collapse" id="startbarCollapse" data-simplebar>
            <div class="d-flex align-items-start flex-column w-100">
                <!-- Navigation -->
                <ul class="navbar-nav mb-auto w-100">

                    @foreach ($menus as $menu)

                        {{-- PARENT MENU → JADI LABEL --}}
                        @if ($menu->manyChild->isNotEmpty())
                            <li class="menu-label mt-2">
                                <span>{{ $menu->name }}</span>
                            </li>

                            @foreach ($menu->manyChild as $child)
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is(ltrim($child->url, '/') . '*') ? 'active' : '' }}"
                                        href="{{ $child->url ? url($child->url) : '#' }}">

                                        @if ($child->icon)
                                            <i class="{{ $child->icon }} menu-icon"></i>
                                        @endif

                                        <span>{{ $child->name }}</span>
                                    </a>
                                </li>
                            @endforeach

                            {{-- MENU TANPA CHILD --}}
                        @else
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is(ltrim($menu->url, '/') . '*') ? 'active' : '' }}"
                                    href="{{ $menu->url ? url($menu->url) : '#' }}">

                                    @if ($menu->icon)
                                        <i class="{{ $menu->icon }} menu-icon"></i>
                                    @endif

                                    <span>{{ $menu->name }}</span>
                                </a>
                            </li>
                        @endif

                    @endforeach

                </ul>

            </div>
        </div><!--end startbar-collapse-->
    </div><!--end startbar-menu-->
</div><!--end startbar-->
<div class="startbar-overlay d-print-none"></div>