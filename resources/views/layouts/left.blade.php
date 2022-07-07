<div class="navigation-menu-tab" data-turbolinks="false">
    <div class="flex-grow-1">
        <ul>
            <li>
                <a class="icon" href="#" data-nav-target="#dashboards">
                    <i data-feather="bar-chart-2"></i>
                    <h5 class="text-center text-white">
                        Dashboard
                    </h5>
                </a>

            </li>
            <li>
                <a class="icon {{ request()->segment(2) == 'master' ? 'active' : '' }}" href="#" data-nav-target="#master">
                    <i data-feather="database"></i>
                    <h5 class="text-center text-white">
                        Master <br> Data
                    </h5>
                </a>
            </li>
            <li>
                <a class="icon {{ request()->segment(2) == 'system' ? 'active' : '' }}" href="#" data-nav-target="#system">
                    <i data-feather="settings"></i>
                    <h5 class="text-center text-white">
                        System
                    </h5>
                </a>
            </li>
            <li>
                <a class="icon" href="#" data-nav-target="#apps">
                    <i data-feather="command"></i>
                    <h5 class="text-center text-white">
                        Apps
                    </h5>
                </a>
            </li>
            <li>
                <a class="icon" href="#" data-nav-target="#elements">
                    <i data-feather="layers"></i>
                    <h5 class="text-center text-white">
                        UI Elements
                    </h5>
                </a>
            </li>
            <li>
                <a class="icon" href="#" data-nav-target="#pages">
                    <i data-feather="copy"></i>
                    <h5 class="text-center text-white">
                        Pages
                    </h5>
                </a>
            </li>
          
            @if(request()->session()->get('akun_status') == 'login')
            <li id="logout_status">
                <a class="icon" href="{{ route('logout') }}">
                    <i data-feather="log-out"></i>
                    <h5 class="text-center text-white">
                        Logout
                    </h5>
                </a>
            </li>
            @else
            <li id="login_status">
               <a class="icon" href="{{ route('login') }}">
                  <i data-feather="log-out"></i>
                  <h5 class="text-center text-white">
                     @if (!session('status'))
                        login
                     @endif
                  </h5>
               </a>
            </li>
            @endif
        </ul>
    </div>
</div>

<!-- begin::navigation menu -->
<div class="navigation-menu-body" data-turbolinks="false">

    <!-- begin::navigation-logo -->
    <div>
        <div id="navigation-logo">
            <a href="{{ url('/') }}">
                <img class="logo" src="{{ url('assets/media/image/logo.png') }}" alt="logo">
                <img class="logo-light" src="{{ url('assets/media/image/logo-light.png') }}" alt="light logo">
            </a>
        </div>
    </div>
    <!-- end::navigation-logo -->

    <div class="navigation-menu-group">

        @if($access = SharedData::get('access'))
        @foreach($access as $acc_key => $acc_data)
        <div class="{{ $acc_key == request()->segment(2) ? 'open' : '' }}" id="{{ $acc_key }}">
            <ul>
                @if($acc_data)
                @foreach($acc_data as $acc)
                @php
                $check_access = request()->segment(2) == $acc[Routes::field_group()] && request()->segment(3) == $acc[Routes::field_slug()];
                @endphp
                <li>
                    <a class="{{ $check_access ? 'active' : '' }}" href="{{ route($acc[Routes::field_slug()].'.getTable') }}">
                        <span>{{ $acc[Routes::field_name()] }}</span>
                    </a>
                </li>
                @endforeach
                @endif
            </ul>
        </div>
        @endforeach
        @endif

        <div @if(!request()->segment(1) || request()->segment(1) == 'dashboards') class="open" @endif
            id="dashboards">
            <ul>
                <li class="navigation-divider">Dashboards</li>
                <li><a @if(!request()->segment(1) || (request()->segment(1) == 'dashboards' &&
                        request()->segment(2) == 'one')) class="active" @endif
                        href="{{ route('dashboards.one') }}">CRM System</a></li>
                <li><a @if(request()->segment(1) == 'dashboards' && request()->segment(2) == 'two')
                        class="active" @endif href="{{ route('dashboards.two') }}">Ecommerce</a></li>
                <li><a @if(request()->segment(1) == 'dashboards' && request()->segment(2) == 'three')
                        class="active" @endif href="{{ route('dashboards.three') }}">Analytics</a></li>
                <li><a @if(request()->segment(1) == 'dashboards' && request()->segment(2) == 'four')
                        class="active" @endif href="{{ route('dashboards.four') }}">Project Management</a>
                </li>
                <li><a @if(request()->segment(1) == 'dashboards' && request()->segment(2) == 'five')
                        class="active" @endif href="{{ route('dashboards.five') }}">Helpdesk Management</a>
                </li>
            </ul>
        </div>
        <div @if(request()->segment(1) == 'apps') class="open" @endif id="apps">
            <ul>
                <li class="navigation-divider">Web Apps</li>
                <li>
                    <a @if(request()->segment(1) == 'apps' && request()->segment(2) == 'chat')
                        class="active" @endif href="{{ route('apps.chat') }}">
                        <span>Chat</span>
                        <span class="badge badge-danger">5</span>
                    </a>
                </li>
                <li>
                    <a @if(request()->segment(1) == 'apps' && request()->segment(2) == 'inbox')
                        class="active" @endif href="{{ route('apps.inbox') }}">
                        <span>Mail</span>
                    </a>
                </li>
                <li>
                    <a @if(request()->segment(1) == 'apps' && request()->segment(2) == 'todo')
                        class="active" @endif href="{{ route('apps.todo') }}">
                        <span>Todo</span>
                        <span class="badge badge-warning">2</span>
                    </a>
                </li>
                <li>
                    <a @if(request()->segment(1) == 'apps' && request()->segment(2) == 'file-manager')
                        class="active" @endif href="{{ route('apps.file-manager') }}">
                        <span>File Manager</span>
                    </a>
                </li>
                <li>
                    <a @if(request()->segment(1) == 'apps' && request()->segment(2) == 'calendar')
                        class="active" @endif href="{{ route('apps.calendar') }}">
                        <span>Calendar</span>
                    </a>
                </li>
            </ul>
        </div>
        <div @if(request()->segment(1) == 'elements') class="open" @endif id="elements">
            <ul>
                <li class="navigation-divider">UI Elements</li>
                <li @if(request()->segment(1) == 'elements' && request()->segment(2) == 'basic')
                    class="open" @endif>
                    <a href="#">Basic</a>
                    <ul>
                        <li><a @if(request()->segment(1) == 'elements' && request()->segment(2) == 'basic'
                                && request()->segment(3) == 'alert') class="active" @endif
                                href="{{ route('elements.basic.alert') }}">Alert</a></li>
                        <li><a @if(request()->segment(1) == 'elements' && request()->segment(2) == 'basic'
                                && request()->segment(3) == 'accordion') class="active" @endif
                                href="{{ route('elements.basic.accordion') }}">Accordion</a></li>
                        <li><a @if(request()->segment(1) == 'elements' && request()->segment(2) == 'basic'
                                && request()->segment(3) == 'buttons') class="active" @endif
                                href="{{ route('elements.basic.buttons') }}">Buttons</a></li>
                        <li><a @if(request()->segment(1) == 'elements' && request()->segment(2) == 'basic'
                                && request()->segment(3) == 'dropdown') class="active" @endif
                                href="{{ route('elements.basic.dropdown') }}">Dropdown</a></li>
                        <li><a @if(request()->segment(1) == 'elements' && request()->segment(2) == 'basic'
                                && request()->segment(3) == 'list-group') class="active" @endif
                                href="{{ route('elements.basic.list-group') }}">List Group</a></li>
                        <li><a @if(request()->segment(1) == 'elements' && request()->segment(2) == 'basic'
                                && request()->segment(3) == 'pagination') class="active" @endif
                                href="{{ route('elements.basic.pagination') }}">Pagination</a></li>
                        <li><a @if(request()->segment(1) == 'elements' && request()->segment(2) == 'basic'
                                && request()->segment(3) == 'typography') class="active" @endif
                                href="{{ route('elements.basic.typography') }}">Typography</a></li>
                        <li><a @if(request()->segment(1) == 'elements' && request()->segment(2) == 'basic'
                                && request()->segment(3) == 'media-object') class="active" @endif
                                href="{{ route('elements.basic.media-object') }}">Media Object</a></li>
                        <li><a @if(request()->segment(1) == 'elements' && request()->segment(2) == 'basic'
                                && request()->segment(3) == 'progress') class="active" @endif
                                href="{{ route('elements.basic.progress') }}">Progress</a></li>
                        <li><a @if(request()->segment(1) == 'elements' && request()->segment(2) == 'basic'
                                && request()->segment(3) == 'modal') class="active" @endif
                                href="{{ route('elements.basic.modal') }}">Modal</a></li>
                        <li><a @if(request()->segment(1) == 'elements' && request()->segment(2) == 'basic'
                                && request()->segment(3) == 'spinners') class="active" @endif
                                href="{{ route('elements.basic.spinners') }}">Spinners</a></li>
                        <li><a @if(request()->segment(1) == 'elements' && request()->segment(2) == 'basic'
                                && request()->segment(3) == 'navs') class="active" @endif
                                href="{{ route('elements.basic.navs') }}">Navs</a></li>
                        <li><a @if(request()->segment(1) == 'elements' && request()->segment(2) == 'basic'
                                && request()->segment(3) == 'tab') class="active" @endif
                                href="{{ route('elements.basic.tab') }}">Tab</a></li>
                        <li><a @if(request()->segment(1) == 'elements' && request()->segment(2) == 'basic'
                                && request()->segment(3) == 'tooltip') class="active" @endif
                                href="{{ route('elements.basic.tooltip') }}">Tooltip</a></li>
                        <li><a @if(request()->segment(1) == 'elements' && request()->segment(2) == 'basic'
                                && request()->segment(3) == 'popovers') class="active" @endif
                                href="{{ route('elements.basic.popovers') }}">Popovers</a></li>
                    </ul>
                </li>
                <li @if(request()->segment(1) == 'elements' && request()->segment(2) == 'card') class="open"
                    @endif>
                    <a href="#">Cards</a>
                    <ul>
                        <li><a @if(request()->segment(1) == 'elements' && request()->segment(2) == 'card' &&
                                request()->segment(3) == 'basic') class="active" @endif
                                href="{{ route('elements.card.basic') }}">Basic Cards </a></li>
                        <li><a @if(request()->segment(1) == 'elements' && request()->segment(2) == 'card' &&
                                request()->segment(3) == 'image') class="active" @endif
                                href="{{ route('elements.card.image') }}">Image Cards </a></li>
                        <li><a @if(request()->segment(1) == 'elements' && request()->segment(2) == 'card' &&
                                request()->segment(3) == 'scroll') class="active" @endif
                                href="{{ route('elements.card.scroll') }}">Card Scroll </a></li>
                        <li><a @if(request()->segment(1) == 'elements' && request()->segment(2) == 'card' &&
                                request()->segment(3) == 'other') class="active" @endif
                                href="{{ route('elements.card.other') }}">Others </a></li>
                    </ul>
                </li>
                <li><a @if(request()->segment(1) == 'elements' && request()->segment(2) == 'avatar')
                        class="active" @endif href="{{ route('elements.avatar') }}">Avatar</a></li>
                <li><a @if(request()->segment(1) == 'elements' && request()->segment(2) == 'icons')
                        class="active" @endif href="{{ route('elements.icons') }}">Icons</a></li>
                <li><a @if(request()->segment(1) == 'elements' && request()->segment(2) == 'colors')
                        class="active" @endif href="{{ route('elements.colors') }}">Colors</a></li>
                <li @if(request()->segment(1) == 'elements' && request()->segment(2) == 'plugin')
                    class="open" @endif>
                    <a href="#">Plugins</a>
                    <ul>
                        <li><a @if(request()->segment(1) == 'elements' && request()->segment(2) == 'plugin'
                                && request()->segment(3) == 'sweet-alert') class="active" @endif
                                href="{{ route('elements.plugin.sweet-alert') }}">Sweet Alert</a></li>
                        <li><a @if(request()->segment(1) == 'elements' && request()->segment(2) == 'plugin'
                                && request()->segment(3) == 'lightbox') class="active" @endif
                                href="{{ route('elements.plugin.lightbox') }}">Lightbox</a></li>
                        <li><a @if(request()->segment(1) == 'elements' && request()->segment(2) == 'plugin'
                                && request()->segment(3) == 'toast') class="active" @endif
                                href="{{ route('elements.plugin.toast') }}">Toast</a></li>
                        <li><a @if(request()->segment(1) == 'elements' && request()->segment(2) == 'plugin'
                                && request()->segment(3) == 'tour') class="active" @endif
                                href="{{ route('elements.plugin.tour') }}">Tour</a></li>
                        <li><a @if(request()->segment(1) == 'elements' && request()->segment(2) == 'plugin'
                                && request()->segment(3) == 'slick-slide') class="active" @endif
                                href="{{ route('elements.plugin.slick-slide') }}">Slick Slide</a></li>
                        <li><a @if(request()->segment(1) == 'elements' && request()->segment(2) == 'plugin'
                                && request()->segment(3) == 'nestable') class="active" @endif
                                href="{{ route('elements.plugin.nestable') }}">Nestable</a></li>
                    </ul>
                </li>
                <li @if(request()->segment(1) == 'elements' && request()->segment(2) == 'form') class="open"
                    @endif>
                    <a href="#">Forms</a>
                    <ul>
                        <li><a @if(request()->segment(1) == 'elements' && request()->segment(2) == 'form' &&
                                request()->segment(3) == 'basic') class="active" @endif
                                href="{{ route('elements.form.basic') }}">Form Layouts</a></li>
                        <li><a @if(request()->segment(1) == 'elements' && request()->segment(2) == 'form' &&
                                request()->segment(3) == 'custom') class="active" @endif
                                href="{{ route('elements.form.custom') }}">Custom Forms</a></li>
                        <li><a @if(request()->segment(1) == 'elements' && request()->segment(2) == 'form' &&
                                request()->segment(3) == 'advanced') class="active" @endif
                                href="{{ route('elements.form.advanced') }}">Advanced Form</a></li>
                        <li><a @if(request()->segment(1) == 'elements' && request()->segment(2) == 'form' &&
                                request()->segment(3) == 'validation') class="active" @endif
                                href="{{ route('elements.form.validation') }}">Validation</a></li>
                        <li><a @if(request()->segment(1) == 'elements' && request()->segment(2) == 'form' &&
                                request()->segment(3) == 'wizard') class="active" @endif
                                href="{{ route('elements.form.wizard') }}">Wizard</a></li>
                        <li><a @if(request()->segment(1) == 'elements' && request()->segment(2) == 'form' &&
                                request()->segment(3) == 'file-upload') class="active" @endif
                                href="{{ route('elements.form.file-upload') }}">File Upload</a></li>
                        <li><a @if(request()->segment(1) == 'elements' && request()->segment(2) == 'form' &&
                                request()->segment(3) == 'datepicker') class="active" @endif
                                href="{{ route('elements.form.datepicker') }}">Datepicker</a></li>
                        <li><a @if(request()->segment(1) == 'elements' && request()->segment(2) == 'form' &&
                                request()->segment(3) == 'timepicker') class="active" @endif
                                href="{{ route('elements.form.timepicker') }}">Timepicker</a></li>
                        <li><a @if(request()->segment(1) == 'elements' && request()->segment(2) == 'form' &&
                                request()->segment(3) == 'colorpicker') class="active" @endif
                                href="{{ route('elements.form.colorpicker') }}">Colorpicker</a></li>
                    </ul>
                </li>
                <li @if(request()->segment(1) == 'elements' && request()->segment(2) == 'table')
                    class="open" @endif>
                    <a href="#">Tables</a>
                    <ul>
                        <li><a @if(request()->segment(1) == 'elements' && request()->segment(2) == 'table'
                                && request()->segment(3) == 'basic') class="active" @endif
                                href="{{ route('elements.table.basic') }}">Basic Tables</a></li>
                        <li><a @if(request()->segment(1) == 'elements' && request()->segment(2) == 'table'
                                && request()->segment(3) == 'datatable') class="active" @endif
                                href="{{ route('elements.table.datatable') }}">Datatable</a></li>
                        <li><a @if(request()->segment(1) == 'elements' && request()->segment(2) == 'table'
                                && request()->segment(3) == 'responsive') class="active" @endif
                                href="{{ route('elements.table.responsive') }}">Responsive Tables</a></li>
                    </ul>
                </li>
                <li @if(request()->segment(1) == 'elements' && request()->segment(2) == 'chart')
                    class="open" @endif>
                    <a href="#">Charts</a>
                    <ul>
                        <li><a @if(request()->segment(1) == 'elements' && request()->segment(2) == 'chart'
                                && request()->segment(3) == 'apexchart') class="active" @endif
                                href="{{ route('elements.chart.apexchart') }}">Apex</a></li>
                        <li><a @if(request()->segment(1) == 'elements' && request()->segment(2) == 'chart'
                                && request()->segment(3) == 'chartjs') class="active" @endif
                                href="{{ route('elements.chart.chartjs') }}">Chartjs</a></li>
                        <li><a @if(request()->segment(1) == 'elements' && request()->segment(2) == 'chart'
                                && request()->segment(3) == 'justgage') class="active" @endif
                                href="{{ route('elements.chart.justgage') }}">Justgage</a></li>
                        <li><a @if(request()->segment(1) == 'elements' && request()->segment(2) == 'chart'
                                && request()->segment(3) == 'morsis') class="active" @endif
                                href="{{ route('elements.chart.morsis') }}">Morsis</a></li>
                        <li><a @if(request()->segment(1) == 'elements' && request()->segment(2) == 'chart'
                                && request()->segment(3) == 'peity') class="active" @endif
                                href="{{ route('elements.chart.peity') }}">Peity</a></li>
                    </ul>
                </li>
                <li @if(request()->segment(1) == 'elements' && request()->segment(2) == 'map') class="open"
                    @endif>
                    <a href="#">Maps</a>
                    <ul>
                        <li><a @if(request()->segment(1) == 'elements' && request()->segment(2) == 'map' &&
                                request()->segment(3) == 'google') class="active" @endif
                                href="{{ route('elements.map.google') }}">Google</a></li>
                        <li><a @if(request()->segment(1) == 'elements' && request()->segment(2) == 'map' &&
                                request()->segment(3) == 'vector') class="active" @endif
                                href="{{ route('elements.map.vector') }}">Vector</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div @if(request()->segment(1) == 'pages') class="open" @endif id="pages">
            <ul>
                <li class="navigation-divider">Pages</li>
                <li><a href="{{ route('pages.login') }}">Login</a></li>
                <li><a href="{{ route('pages.register') }}">Register</a></li>
                <li><a href="{{ route('pages.recovery-password') }}">Recovery Password</a></li>
                <li><a href="{{ route('pages.lock-screen') }}">Lock Screen</a></li>
                <li><a @if(request()->segment(1) == 'pages' && request()->segment(2) == 'profile')
                        class="active" @endif href="{{ route('pages.profile') }}">Profile</a></li>
                <li><a @if(request()->segment(1) == 'pages' && request()->segment(2) == 'timeline')
                        class="active" @endif href="{{ route('pages.timeline') }}">Timeline</a></li>
                <li><a @if(request()->segment(1) == 'pages' && request()->segment(2) == 'invoice')
                        class="active" @endif href="{{ route('pages.invoice') }}">Invoice</a></li>

                <li><a @if(request()->segment(1) == 'pages' && request()->segment(2) == 'pricing-table')
                        class="active" @endif href="{{ route('pages.pricing-table') }}">Pricing Table</a>
                </li>
                <li><a @if(request()->segment(1) == 'pages' && request()->segment(2) == 'search-result')
                        class="active" @endif href="{{ route('pages.search-result') }}">Search Result</a>
                </li>
                <li @if(request()->segment(2) == 'errors') class="open" @endif >
                    <a href="#">Error Pages</a>
                    <ul>
                        <li><a href="{{ route('pages.errors.404') }}">404</a></li>
                        <li><a @if(request()->segment(1) == 'pages' && request()->segment(2) == 'errors' &&
                                request()->segment(3) == '404-2') class="active" @endif
                                href="{{ route('pages.errors.404-2') }}">404 V2</a></li>
                        <li><a href="{{ route('pages.errors.503') }}">503</a></li>
                        <li><a href="{{ route('pages.errors.mean-at-work') }}">Mean at Work</a></li>
                    </ul>
                </li>
                <li><a @if(request()->segment(1) == 'pages' && request()->segment(2) == 'blank-page')
                        class="active" @endif href="{{ route('pages.blank-page') }}">Starter Page</a></li>
                <li>
                    <a href="#">Email Templates</a>
                    <ul>
                        <li><a href="{{ route('pages.email-template-basic') }}">Basic</a></li>
                        <li><a href="{{ route('pages.email-template-alert') }}">Alert</a></li>
                        <li><a href="{{ route('pages.email-template-billing') }}">Billing</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Menu Level</a>
                    <ul>
                        <li>
                            <a href="#">Menu Level</a>
                            <ul>
                                <li>
                                    <a href="#">Menu Level </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- end::navigation menu -->
