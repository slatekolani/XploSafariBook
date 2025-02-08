<style>
    .navbar {
        background-color: dodgerblue;
        padding: 0.5rem 1rem;
        position: fixed;
        /* Ensure the navbar is fixed */
        width: 100%;
        /* Full width */
        z-index: 1000;
        /* Ensure it stays above other content */
    }

    .navbar.hidden {
        transform: translateY(-100%);
    }

    .navbar-brand {
        display: flex;
        align-items: center;
    }

    .companyLogo {
        width: 80px;
        height: 70px;
        transition: transform 0.3s ease;
    }

    .companyLogo:hover {
        transform: scale(1.1);
    }

    .navbar-nav .nav-link {
        color: white !important;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .navbar-nav .nav-link:hover {
        color: #ffd700 !important;
    }

    .navbar-nav .nav-link2 {
        color: black !important;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .navbar-nav .nav-link2:hover {
        color: dodgerblue !important;
    }

    .dropdown-menu {
        background-color: #1e90ff;
        border: none;
    }

    .dropdown-item {
        color: white;
    }

    .dropdown-item:hover {
        background-color: #4169e1;
    }

    .search-form {
        display: flex;
    }

    .search-form .form-control {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }

    .search-form .btn {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }

    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(0, 0, 0, 0.85)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }

    .nav-icons {
        display: flex;
        align-items: center;
        margin-left: 1rem;
    }

    .nav-icons a {
        color: white;
        margin: 0 0.5rem;
        transition: color 0.3s ease;
    }

    .nav-icons a:hover {
        color: #ffd700;
    }

    .btn-signup {
        background-color: transparent;
        border: white;
        border-radius: 10px;
        color: white !important;
        padding: 0.5rem 1rem;
        border-radius: 0.25rem;
        font-weight: 500;
        margin-left: 1rem;
        transition: all 0.3s ease;
    }

    .btn-signup:hover {
        background-color: #fff;
        color: dodgerblue !important;
        text-decoration: none;
    }

    @media (max-width: 991px) {
        .nav-icons {
            margin: 1rem 0;
            justify-content: center;

        }

        .btn-signup {
            margin: 1rem 0;
            display: block;
            text-align: center;
        }
    }

    @media (max-width: 991px) {
        .navbar-collapse {
            background-color: #1e90fff2;
            padding: 1rem;
            border-radius: 0.5rem;
        }

        .navbar-nav .nav-link {
            color: white !important;
        }

        .search-form {
            margin-top: 1rem;
        }
    }

    .header {
        display: flex;
        align-items: center;
        background-color: white;
        padding: 0.5rem 1rem;
        position: fixed;
        width: 100%;
        z-index: 1000;
    }

    .userbox {
        margin-left: auto;
        padding: 15px;
    }

    .profile-info {
        color: black;
    }

    .navbar-toggler {
        border-color: rgba(255, 255, 255, 0.1);
    }



    @media (max-width: 991px) {
        .navbar-collapse {
            background-color: rgba(30, 144, 255, 0.95);
            padding: 1rem;
            border-radius: 0.5rem;
        }

        .navbar-nav .nav-link {
            color: white !important;
        }
    }
</style>

@guest
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ url('/public/HomeImages/Xplo Safari Book white-01.png') }}" alt="{{ config('app.name') }}"
                    class="companyLogo" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <form class="d-flex flex-grow-1 mx-3" type="get" action="{{ route('localTourPackage.search') }}">
                <div class="input-group">
                    <input class="form-control" type="search" id="form1" name="search"
                        placeholder="Travel destination?" aria-label="Search">
                    <button class="btn btn-outline-secondary" type="submit" aria-label="Submit search">
                        <i class="fas fa-search" style="color: white"> Search</i>
                    </button>
                </div>
            </form>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="localSafariDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Local Safari's & Tours
                        </a>
                        <div class="dropdown-menu" aria-labelledby="localSafariDropdown">
                            <a class="dropdown-item" href="{{ route('localTourPackage.allLocalTourPackages') }}">All Local
                                Trips</a>
                            <a class="dropdown-item"
                                href="{{ route('localTourPackage.TripKind', ['trip_kind_name' => 'dayAdventure']) }}">Day
                                Trips</a>
                            <a class="dropdown-item"
                                href="{{ route('localTourPackage.TripKind', ['trip_kind_name' => 'weekendGateway']) }}">Weekend
                                Getaways</a>
                            <a class="dropdown-item"
                                href="{{ route('localTourPackage.TripKind', ['trip_kind_name' => 'weekLongAdventure']) }}">Week-long
                                Adventures</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('tourOperator.allTourOperators') }}">Tour Operators</a>
                    </li>


                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Others
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('touristicGame.allTouristicGames') }}">Touristic
                                games</a>
                            <a class="dropdown-item" href="{{ route('platformFaq.publicView') }}">FAQ</a>
                            <a class="dropdown-item" href="{{ route('travelEducation.publicView') }}">Travel Education</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" style="color: #ffd700">Bon Voyage...</a>
                        </div>
                    </li>
                </ul>
               
                <div class="nav-icons">
                    
                    <a href="{{ route('register') }}" class="btn-signup">Register</a>
                    <a href="{{ route('login') }}" class="btn-signup">Log In</a>
                </div>
            </div>

        </div>
    </nav>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endguest

@auth
    @if (Auth::user()->role == 1 || Auth::user()->role ==2)
        <header class="header navbar navbar-expand-lg">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ url('/public/HomeImages/Xplo Safari Book Logo.png') }}" alt="{{ config('app.name') }}"
                    class="companyLogo" />
            </a>

            <!-- Navbar Toggler for Small Screens -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAuthContent"
                aria-controls="navbarAuthContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarAuthContent">
                <ul class="navbar-nav ml-auto">
                    <!-- Profile Info and Logout inside the navbar for mobile -->
                    <li class="nav-item dropdown">
                        <a class="nav-link2 dropdown-toggle" href="#" id="profileDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i> {{ access()->user()->username }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('user.profile', access()->user()) }}">
                                    <i class="fas fa-user"></i> @lang('label.my_profile')
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-briefcase"></i> Manual
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-power-off"></i> @lang('label.logout')
                                </a>
                            </li>
                            <!-- Logout Form -->
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </ul>
                    </li>
                </ul>
            </div>
        </header>
        @elseif (Auth::user()->role == 3)
        <nav class="navbar navbar-expand-lg">
            <div class="container d-flex align-items-center justify-content-between">
                <!-- Logo -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ url('/public/HomeImages/Xplo Safari Book white-01.png') }}"
                        alt="{{ config('app.name') }}" class="companyLogo" />
                </a>
                <!-- Navbar Items -->
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <form class="d-flex flex-grow-1 mx-3" type="get" action="{{ route('localTourPackage.search') }}">
                    <div class="input-group">
                        <input class="form-control" type="search" id="form1" name="search"
                            placeholder="Travel destination?" aria-label="Search">
                        <button class="btn btn-outline-secondary" type="submit" aria-label="Submit search">
                            <i class="fas fa-search" style="color: white"> Search</i>
                        </button>
                    </div>
                </form>
    
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        <!-- Local Safari Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="localSafariDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Local Safari's & Tours
                            </a>
                            <div class="dropdown-menu" aria-labelledby="localSafariDropdown">
                                <a class="dropdown-item" href="{{ route('localTourPackage.allLocalTourPackages') }}">All
                                    Local Trips</a>
                                <a class="dropdown-item"
                                    href="{{ route('localTourPackage.TripKind', ['trip_kind_name' => 'dayAdventure']) }}">Day
                                    Trips</a>
                                <a class="dropdown-item"
                                    href="{{ route('localTourPackage.TripKind', ['trip_kind_name' => 'weekendGateway']) }}">Weekend
                                    Getaways</a>
                                <a class="dropdown-item"
                                    href="{{ route('localTourPackage.TripKind', ['trip_kind_name' => 'weekLongAdventure']) }}">Week-long
                                    Adventures</a>
                            </div>
                        </li>
    
                        <!-- Tour Operators -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('tourOperator.allTourOperators') }}">Tour Operators</a>
                        </li>
    
                        <!-- Others Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Others
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('touristicGame.allTouristicGames') }}">Touristic
                                    Games</a>
                                <a class="dropdown-item" href="{{ route('platformFaq.publicView') }}">FAQ</a>
                                <a class="dropdown-item" href="{{ route('travelEducation.publicView') }}">Travel
                                    Education</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" style="color: #ffd700">Bon Voyage...</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.profile', access()->user()) }}">My Profile</a>
                        </li>
                        
                    </ul>
    
                    <!-- Nav Icons -->
                    <div class="nav-icons ms-3">
                        <a href="#" title="Favorites"><i class="fas fa-heart" style="font-size: 20px"></i></a>
                        <a href="#" title="Cart"><i class="fas fa-shopping-cart" style="font-size: 20px"></i></a>
                        <a href="#" title="Reading List"><i class="fas fa-book" style="font-size: 20px"></i></a>
                    </div>

                </div>
            </div>
        </nav>
    @endif
    

@endauth

@push('after-scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endpush
