
@if(Auth::user()->role == 1)
@include('includes/components/left_sidebars/admin')
@elseif(Auth::user()->role==2)
@include('includes/components/left_sidebars/tourOperator')
@elseif(Auth::user()->role==3)
@include('includes/components/left_sidebars/tourist')
@else

@endif
