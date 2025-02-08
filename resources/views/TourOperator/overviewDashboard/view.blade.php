<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <strong>Companies Information</strong>
            </div>
        </div>
    </div>
</div>
<div class="row" style="padding-top: 5px">
    <div class="col-md-4">
        <div class="list-group">
            <ul class="list-unstyled">
                <a href="{{route('tourOperator.index')}}" class="list-group-item list-group-item-action">
                    <h5 class="list-group-item-heading"><i class="fas fa-list"></i> {{ __('All Companies') }}~ <badge class="badge badge-primary badge-lg" style="font-size: 15px">{{Auth::user()->getTotalNumberOfCompanies()}}</badge></h5>
                    <p class=""></p>
                </a>
            </ul>
        </div>
    </div>

    <div class="col-md-4">
        <div class="list-group">
            <ul class="list-unstyled">
                <a href="{{route('tourOperator.verifiedCompaniesIndex')}}" class="list-group-item list-group-item-action">
                    <h5 class="list-group-item-heading"><i class="fas fa-list"></i> {{ __('Verified') }} ~ <badge class="badge badge-success badge-lg" style="font-size: 15px">{{Auth::user()->getTotalNumberOfVerifiedCompanies()}}</badge></h5>
                    <p class=""></p>
                </a>
            </ul>
        </div>
    </div>

    <div class="col-md-4">
        <div class="list-group">
            <ul class="list-unstyled">
                <a href="{{route('tourOperator.UnverifiedCompaniesIndex')}}" class="list-group-item list-group-item-action">
                    <h5 class="list-group-item-heading"><i class="fas fa-list"></i> {{ __('Un-verified') }} ~ <badge class="badge badge-danger badge-lg" style="font-size: 15px">{{Auth::user()->getTotalNumberOfUnverifiedCompanies()}}</badge></h5>
                    <p class=""></p>
                </a>
            </ul>
        </div>
    </div>

</div>


