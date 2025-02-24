@if (Auth::user()->role == 1 || Auth::user()->role ==2)

<div class="row">
    <div class="col-md-12">
        <section class="card card-primary mb-4">
            <header class="card-header card-header-custom">
                <div class="card-actions">
                    {{--Action Links--}}

                    <div class="row">
                        <div class="col-md-12" >
                            <div class="pull-right" >
                                <a href="#changePasswordModal" data-toggle="modal"   ><i class="fas fa-key"></i>&nbsp;{{ __('label.change_password') }}</a>&nbsp;&nbsp;
                                <a class =''  href="{{ route('user.edit', $user->uuid) }}"  ><i class="fas fa-user-edit"></i>&nbsp;{{ __('label.crud.edit') }}</a>&nbsp;&nbsp;

                                <a href="#" class="card-action card-action-toggle" data-card-toggle=""></a>
                            </div>
                        </div>
                    </div>

                </div>

                <h2 class="card-title">{{ __('label.user_registration.user_info') }}</h2>
            </header>
            <div class="card-body">

                {{--CONTENT--}}
                {{--1--}}
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">

                            {{--Left--}}
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-4" >{{ __('label.username')}}:</label>
                                    <label class="col-lg-8 ">{{ $user->username }}</label>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-4" >{{ __('label.mobile')}}:</label>
                                    <label class="col-lg-8">{{ $user->phone }}</label>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                {{--3--}}
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">

                            {{--Left--}}
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-4" >{{ __('label.email')}}:</label>
                                    <label class="col-lg-8">{{ $user->email }}</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-4" >{{ __('label.registration_date')}}:</label>
                                    <label class="col-lg-8">{{ $user->created_at_formatted }}</label>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>



</div>



{{--Change Passwrod MODAL--}}
@include('access/user/profile/modals/change_password', ['user' => $user])
@endif

@if (Auth::user()->role == 3)

<div class="container-fluid py-4">
    <div class="row">
        <!-- Left Column: User Profile -->
        <div class="col-md-4">
            <div class="card shadow-lg mb-4">
                <div class="card-body text-center">
                    <div class="position-relative d-inline-block mb-3">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" 
                                 style="width: 150px; height: 150px; font-size: 64px;">
                                {{ strtoupper(substr($user->username, 0, 1)) }}
                            </div>
                        <div class="position-absolute bottom-0 end-0 bg-success rounded-circle p-2">
                            <i class="fas fa-check text-white" style="font-size: 16px;"></i>
                        </div>
                    </div>
                    
                    <h3 class="mb-2">{{ $user->username }}</h3>
                    <p class="text-muted mb-4">{{ $user->email }}</p>
                    
                    <div class="d-flex flex-column flex-sm-row justify-content-center align-items-center mb-3 gap-2" style="padding:10px 10px 10px 10px">
                        <a href="{{ route('user.edit', $user->uuid) }}" 
                           class="btn btn-outline-primary w-100 w-sm-auto">
                            <i class="fas fa-user-edit"></i> Edit Profile
                        </a>
                        <a href="#changePasswordModal" 
                           data-bs-toggle="modal" 
                           class="btn btn-outline-secondary w-100 w-sm-auto">
                            <i class="fas fa-key"></i> Change Password
                        </a>
                        <a class="btn btn-outline-danger w-100 w-sm-auto" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-power-off"></i> @lang('label.logout')
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: User Analytics and Information -->
        <div class="col-md-8">
            <div class="row">
                <!-- Analytics Cards -->
                <div class="col-md-6 mb-6" style="margin-top: 50px">
                    <a href="{{route('tourist.bookingsMadeByTourist')}}" style="text-decoration: none">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary text-white rounded-circle p-3 me-3">
                                        <i class="fas fa-calendar-alt" style="font-size:15px"></i>
                                    </div>
                                    <div>
                                        <h5 class="card-title text-muted mb-0">Local Tour Bookings</h5>
                                        <p class="display-6 fw-bold mb-0" style="text-align: center">
                                            {{$user->getTotalBookingsMadeByTourist()?? 0 }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    
                </div>

                <div class="col-md-6 mb-6" style="margin-top: 50px">
                    <a href="{{route('tourist.customTourBookings')}}" style="text-decoration: none">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary text-white rounded-circle p-3 me-3">
                                        <i class="fas fa-calendar-alt" style="font-size:15px"></i>
                                    </div>
                                    <div>
                                        <h5 class="card-title text-muted mb-0">Custom Tour Bookings</h5>
                                        <p class="display-6 fw-bold mb-0" style="text-align: center">
                                            {{$user->getTotalCustomTourBookingsMadeByTourist()?? 0 }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    
                </div>
                
                <div class="col-md-6 mb-6" style="margin-top: 50px">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="bg-success text-white rounded-circle p-3 me-3">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                                <div>
                                    <h5 class="card-title text-muted mb-0">Total Spent</h5>
                                    <p class="display-6 fw-bold mb-0" style="text-align: center">
                                        ${{ number_format($totalSpent ?? 0, 2) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 mb-6" style="margin-top: 50px">
                    <a href="{{route('tourist.destinationTravelledbyUser')}}" style="text-decoration: none">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="bg-warning text-white rounded-circle p-3 me-3">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div>
                                        <h5 class="card-title text-muted mb-0">Destinations</h5>
                                        <p class="display-6 fw-bold mb-0" style="text-align: center">
                                            {{ $user->getTotalDestinationsTravelledByTourist() ?? 0 }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Detailed User Information -->
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h4 class="mb-0">Personal Information</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="d-flex">
                                <strong class="me-2">Username | </strong> 
                                <p>{{ $user->username }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex">
                                <strong class="me-2">Mobile | </strong>
                                <p>{{ $user->phone ?? 'Not provided' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="d-flex">
                                <strong class="me-2">Email | </strong>
                                <p>{{ $user->email }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex">
                                <strong class="me-2">Registered | </strong>
                                <p>{{ $user->created_at_formatted }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Change Password Modal -->
@include('access/user/profile/modals/change_password', ['user' => $user])

<!-- Optional Custom Styles -->
<style>
    .card {
        border-radius: 12px;
        overflow: hidden;
    }
    .card-body {
        padding: 1.5rem;
    }
</style>
    
@endif