<div class="startbar d-print-none">
    <!--start brand-->
    <div class="brand">
        <a href="{{ route('any', 'index')}}" class="logo">
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
                    <li class="menu-label mt-2">
                        <span>Main</span>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('any', 'index')}}">
                            <i class="iconoir-report-columns menu-icon"></i>
                            <span>Dashboard</span>
                            <span class="badge text-bg-info ms-auto">New</span>
                        </a>
                    </li><!--end nav-item-->
                    <li class="menu-label mt-2">
                        <span>Management</span>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.index') }}">
                            <i class="iconoir-group menu-icon"></i>
                            <span>Users</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('roles.index') }}">
                            <i class="iconoir-shield-check menu-icon"></i>
                            <span>Roles</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('languages.index') }}">
                            <i class="iconoir-language menu-icon"></i>
                            <span>Languages</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('questions.index') }}">
                            <i class="iconoir-chat-bubble-check menu-icon"></i>
                            <span>Questions</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('submissions.index') }}">
                            <i class="iconoir-send-mail menu-icon"></i>
                            <span>Inbox</span>
                        </a>
                    </li>

                    <li class="menu-label mt-2">
                        <span>Applications</span>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('any', 'apps-calendar') }}">
                            <i class="iconoir-calendar menu-icon"></i>
                            <span>Calendar</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('any', 'apps-chat') }}">
                            <i class="iconoir-chat-lines menu-icon"></i>
                            <span>Chat</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('any', 'apps-invoice') }}">
                            <i class="iconoir-paste-clipboard menu-icon"></i>
                            <span>Invoice</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('any', 'contact-list') }}">
                            <i class="iconoir-group menu-icon"></i>
                            <span>Contact List</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#sidebarTransactions" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarTransactions">
                            <i class="iconoir-nav-arrow-down menu-icon"></i>
                            <span>Transactions</span>
                        </a>
                        <div class="collapse" id="sidebarTransactions">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('second', ['transaction', 'transaction']) }}">Transaction</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('second', ['transaction', 'new-transaction']) }}">New
                                        Transaction</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="menu-label mt-2">
                        <span>Components</span>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#sidebarCharts" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarCharts">
                            <i class="iconoir-candlestick-chart menu-icon"></i>
                            <span>Charts</span>
                        </a>
                        <div class="collapse" id="sidebarCharts">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('third', ['components', 'charts', 'apex']) }}">Apex</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('third', ['components', 'charts', 'chartjs']) }}">Chartjs</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('third', ['components', 'charts', 'justgage']) }}">JustGage</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('third', ['components', 'charts', 'toast']) }}">Toast</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#sidebarMaps" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarMaps">
                            <i class="iconoir-map-pin menu-icon"></i>
                            <span>Maps</span>
                        </a>
                        <div class="collapse" id="sidebarMaps">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('third', ['components', 'maps', 'google']) }}">Google</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('third', ['components', 'maps', 'leaflet']) }}">Leaflet</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('third', ['components', 'maps', 'vector']) }}">Vector</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#sidebarIcons" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarIcons">
                            <i class="iconoir-hexagon-dice menu-icon"></i>
                            <span>Icons</span>
                        </a>
                        <div class="collapse" id="sidebarIcons">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('third', ['components', 'icons', 'font-awesome']) }}">Font
                                        Awesome</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('third', ['components', 'icons', 'line-awesome']) }}">Line
                                        Awesome</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('third', ['components', 'icons', 'iconoir']) }}">Iconoir</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#sidebarEmailTemplates" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarEmailTemplates">
                            <i class="iconoir-send-mail menu-icon"></i>
                            <span>Email Templates</span>
                        </a>
                        <div class="collapse" id="sidebarEmailTemplates">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('third', ['components', 'email', 'basic-action']) }}">Basic
                                        Action</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('third', ['components', 'email', 'template-alert']) }}">Alert
                                        Email</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('third', ['components', 'email', 'template-billing']) }}">Billing
                                        Email</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#sidebarUi" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarUi">
                            <i class="iconoir-compact-disc menu-icon"></i>
                            <span>UI Elements</span>
                        </a>
                        <div class="collapse" id="sidebarUi">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('third', ['components', 'ui', 'alerts']) }}">Alerts</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('third', ['components', 'ui', 'buttons']) }}">Buttons</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('third', ['components', 'ui', 'cards']) }}">Cards</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('third', ['components', 'ui', 'modals']) }}">Modals</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('third', ['components', 'ui', 'typography']) }}">Typography</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#sidebarAdvancedUi" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarAdvancedUi">
                            <i class="iconoir-peace-hand menu-icon"></i>
                            <span>Advanced UI</span>
                        </a>
                        <div class="collapse" id="sidebarAdvancedUi">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('third', ['components', 'advanced', 'animation']) }}">Animation</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('third', ['components', 'advanced', 'sweetalerts']) }}">Sweet
                                        Alerts</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('third', ['components', 'advanced', 'ratings']) }}">Ratings</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#sidebarForms" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarForms">
                            <i class="iconoir-journal-page menu-icon"></i>
                            <span>Forms</span>
                        </a>
                        <div class="collapse" id="sidebarForms">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('third', ['components', 'forms', 'elements']) }}">Basic
                                        Elements</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('third', ['components', 'forms', 'advanced']) }}">Advance
                                        Elements</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('third', ['components', 'forms', 'validation']) }}">Validation</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#sidebarTables" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarTables">
                            <i class="iconoir-table-rows menu-icon"></i>
                            <span>Tables</span>
                        </a>
                        <div class="collapse" id="sidebarTables">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('third', ['components', 'tables', 'basic']) }}">Basic</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('third', ['components', 'tables', 'datatable']) }}">Datatables</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#sidebarPages" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarPages">
                            <i class="iconoir-page-flip menu-icon"></i>
                            <span>Pages</span>
                        </a>
                        <div class="collapse" id="sidebarPages">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('second', ['pages', 'profile']) }}">Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('second', ['pages', 'notification']) }}">Notifications</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('second', ['pages', 'starter']) }}">Starter
                                        Page</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('second', ['pages', 'blogs']) }}">Blogs</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('second', ['pages', 'faqs']) }}">FAQs</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('second', ['pages', 'gallery']) }}">Gallery</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('second', ['pages', 'pricing']) }}">Pricing</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('second', ['pages', 'timeline']) }}">Timeline</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('second', ['pages', 'treeview']) }}">Treeview</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('any', 'payment') }}">Payment</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('any', 'taxes') }}">Taxes</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('any', 'users') }}">Users List (Tpl)</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#sidebarAuth" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarAuth">
                            <i class="iconoir-fingerprint-lock-circle menu-icon"></i>
                            <span>Authentication</span>
                        </a>
                        <div class="collapse" id="sidebarAuth">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('second', ['auth', 'login']) }}">Log In</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('second', ['auth', 'register']) }}">Register</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('second', ['auth', 'recover-pw']) }}">Recover
                                        Password</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('second', ['auth', 'lock-screen']) }}">Lock
                                        Screen</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('second', ['auth', 'error-404']) }}">Error
                                        404</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('second', ['auth', 'error-500']) }}">Error
                                        500</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('second', ['auth', 'maintenance']) }}">Maintenance</a>
                                </li>
                            </ul>
                        </div>
                    </li>

            </div>
        </div><!--end startbar-collapse-->
    </div><!--end startbar-menu-->
</div><!--end startbar-->
<div class="startbar-overlay d-print-none"></div>