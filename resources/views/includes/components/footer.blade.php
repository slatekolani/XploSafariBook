@guest
    <div id="bottomNavigation" class="text-center">
        <button type="button" class="btn btn-light mt-3" data-bs-toggle="modal" data-bs-target="#tripFinderModal">
            Find Your Trip Fast
        </button>
        
    </div>
@endguest
@auth
    @if (Auth::user()->role == 3)
    <div id="bottomNavigation">
        <button type="button" class="btn btn-light mt-3 text-left" data-bs-toggle="modal" data-bs-target="#tripFinderModal">
            <a href="{{route('tourist.userManual')}}"><i class="fas fa-briefcase" style="color: dodgerblue;font-size:20px"></i></a>
        </button>
        <button type="button" class="btn btn-light mt-3 text-center" data-bs-toggle="modal" data-bs-target="#tripFinderModal">
            Find Your Trip Fast
        </button>
        
        <button type="button" class="btn btn-light mt-3 rounded-circle" data-bs-toggle="modal" data-bs-target="#tripFinderModal">
            <a href="{{ route('user.profile', access()->user()) }}"><i class="fas fa-user" style="color: dodgerblue;font-size:20px"></i> </a>
        </button>
        
    </div>
    @else
    @endif
@endauth

@auth
@if (Auth::user()->role == 1 || Auth::user()->role == 2)
<div class="row content-body">
    <div class="col-md-12">
        <footer id="footer" style="background-color: #2c3e50; color: white; padding: 40px 0; font-family: Arial, sans-serif;">
            <div class="container py-4">
                <div class="row py-4">
                    <div class="col-lg-6 d-flex align-items-center justify-content-center justify-content-lg-start mb-4 mb-lg-0">
                        <p style="font-size: 18px; margin-bottom: 0;">© Copyright {{ \Carbon\Carbon::now()->format('Y') }}. All Rights Reserved.</p>
                    </div>
                    <div class="col-lg-6 d-flex align-items-center justify-content-center justify-content-lg-end">
                        <p style="font-size: 18px; margin-bottom: 0;">Proud product of Expedition & Exploration Innovations</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
@endif
@endauth
