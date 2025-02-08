<aside id="sidebar-left" class="sidebar-left">

    <div class="sidebar-header">
        <div class="sidebar-title">
            Navigation
        </div>
        <div class="sidebar-toggle d-none d-md-block" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
            <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>

    <div class="nano has-scrollbar">
        <div class="nano-content" tabindex="0" style="right: -15px;">
            <nav id="menu" class="nav-main" role="navigation">

                <ul class="nav nav-main">
                    <li>
                        <a class="nav-link" href="{{ route('user.profile', access()->user()) }}">
                            <i class="fas fa-user" aria-hidden="true"></i>
                            <span>{{ __('label.my_profile') }}</span>
                        </a>
                    </li>

                    {{--Pending workflow--}}
                    <li>
                        <a class="nav-link" href="{{ route('workflow.pending') }}">
                            <i class="fas fa-bell" aria-hidden="true"></i>
                            <span>{{ __('label.administrator.system.workflow.pendings') }}
                                </span>

                            @if(access()->getWorkflowPendingCount() > 0)
                                &nbsp;<span class="badge badge-pill badge-dark" style="font-size:10px">{{ number_0_format(access()->getWorkflowPendingCount())  }} <br/></span>
                            @endif
                        </a>
                    </li>

                </ul>
            </nav>

            <hr class="separator">



        </div>

        <script>
            // Maintain Scroll Position
            if (typeof localStorage !== 'undefined') {
                if (localStorage.getItem('sidebar-left-position') !== null) {
                    var initialPosition = localStorage.getItem('sidebar-left-position'),
                        sidebarLeft = document.querySelector('#sidebar-left .nano-content');

                    sidebarLeft.scrollTop = initialPosition;
                }
            }
        </script>


        <div class="nano-pane" style="opacity: 1; visibility: visible;"><div class="nano-slider" style="height: 428px; transform: translate(0px, 0px);"></div></div></div>

</aside>