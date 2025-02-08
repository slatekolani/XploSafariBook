<aside id="sidebar-left" class="sidebar-left">

    <div class="sidebar-header sidebar-custom">
        <div class="sidebar-title sidebar-custom">
            @lang("label.my_desktop")
        </div>
        <div class="sidebar-toggle d-none d-md-block sidebar-custom" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
            <i class="fas fa-bars" aria-label="Toggle sidebar"></i>

        </div>

    </div>


    <div class="nano sidebar-custom">
        <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">
                {{--1--}}
                <div class="row" align="center">
                    <div class="col-md-12">
                        <a href="{{ route('stakeholder.contact_person.profile') }}"><span class="badge badge-pill badge-success">&nbsp;</span>   {{ access()->user()->name }}</a>

                    </div>
                </div>

                <hr class="hr-separator">


                <ul class="nav nav-main">

                    {{--1--}}
                    <li>
                        <a class="nav-link nav-link-custom" href="{{ route('stakeholder.contact_person.profile') }}">
                            <i class="fas fa-user-circle" aria-hidden="true"></i>
                            <span class="">  {{ __('label.my_profile')}}</span>
                        </a>
                        <hr class="hr-separator">
                    </li>



                    {{--2--}}
                    <li  class="nav-parent nav-expanded">
                        <a class="nav-link nav-link-custom">
                            <i class="fas fa-align-left" aria-hidden="true"></i>
                            <span class="">  {{ __('label.my_activities')}}

                            </span>
                        </a>
                        <ul class="nav nav-children  sidebar-custom" style="">
                            @if (access()->user()->user_account_type == 2 || access()->user()->user_account_type == 3)
                                <li>
                                    <a class="nav-link-custom dark_grey " href= "#">
                                        {{  __('label.business.tenders') }}
                                    </a>
                                </li>
                            @endif
                            @if (access()->user()->user_account_type == 2 )
                                <li>
                                    <a class="nav-link-custom dark_grey " href= "#">
                                        {{  __('label.business.proposals') }}
                                    </a>
                                </li>

                                <li>
                                    <a class="nav-link-custom dark_grey " href= "#">
                                        {{  __('label.business.service_offers') }}
                                    </a>
                                </li>
                            @endif
                            <li>
                                <a class="nav-link-custom dark_grey " href="#">
                                    {{  __('label.information.forum_posts') }}
                                </a>
                            </li>
                                <li>
                                    <a class="nav-link-custom dark_grey " href="{{ route('announcement.index') }}">
                                        @lang('label.information.announcement.announcements')
                                    </a>
                                </li>

                        </ul>




                        <hr class="hr-separator">
                    </li>



                    {{--3--}}
                    <li  class="nav-parent nav-expanded">
                        <a class="nav-link nav-link-custom">
                            <i class="fas fa-search" aria-hidden="true"></i>
                            <span class="">  {{ __('label.quick_find')}}

</span>
                        </a>
                        <ul class="nav nav-children  sidebar-custom" style="">

                            <li>
                                <a class="nav-link-custom dark_grey " href= "#">
                                    {{  __('label.business.cargo') }}
                                </a>
                            </li>
                            <li>
                                <a class="nav-link-custom dark_grey " href= "#">
                                    {{  __('label.business.transportation') }}
                                </a>
                            </li>
                            <li>
                                <a class="nav-link-custom dark_grey " href= "#">
                                    {{  __('label.business.warehouse') }}
                                </a>
                            </li>
                            <li>
                                <a class="nav-link-custom dark_grey " href="#">
                                    {{  __('label.business.insurance_service') }}
                                </a>
                            </li>
                            <li>
                                <a class="nav-link-custom dark_grey " href= "#">
                                    {{  __('label.business.container.container') }}
                                </a>
                            </li>
                        </ul>

                        <hr class="hr-separator">
                    </li>

                    <li>
                        <a class="nav-link nav-link-custom" href="#">
                            <i class="fas fa-audio-description" aria-hidden="true"></i>
                            <span class="">  {{ __('label.stakeholder.my_adverts')}}</span>
                        </a>
                        <hr class="hr-separator">
                    </li>

                    <li>
                        <a class="nav-link nav-link-custom" href="#"">
                        <i class="fas fa-money-bill-alt" aria-hidden="true"></i>
                        <span class="">  {{ __('label.stakeholder.my_payments')}}</span>
                        </a>
                        <hr class="hr-separator">
                    </li>


                    <li>
                        <a class="nav-link nav-link-custom" href="#">
                            {{--<i class="fas fa-money-bill-alt" aria-hidden="true"></i>--}}
                            <span class="">  {{ __('label.stakeholder.package_subscription')}}</span>
                            <span><b>{{ strtoupper(access()->user()->user_subscription) }}</b> </span>
                        </a>

                    </li>



                </ul>

            </nav>

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

    </div>

</aside>






