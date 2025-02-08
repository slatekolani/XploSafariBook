@extends('layouts.main', ['title' => __("Filter Results"), 'header' => __("Filter Results")])

@push('after-styles')
    {{ Html::style(url('vendor/select2/css/select2.min.css')) }}
    <style>

    </style>
@endpush

@section('content')
    @guest
        <div class="col-md-12" style="padding-top: 10px">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h3> Exploring your selected attraction:
                                {{$touristicAttraction->attraction_name}}
                            </h3>
                                <div class="alertAbsence" style="margin-top: 30px">
                                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                                    <strong>Whoops!</strong> {{ucfirst(' We are sorry, but it seems that neither the safari package you are looking for nor a tour operator operating in that attraction is available on our platform. However, we can assist you in finding a suitable tour operator. Please do not hesitate to contact us via WhatsApp or email. We highly prioritize your privacy and assure you that your contact information will not be shared with any third parties. For more details, please review our comprehensive terms and conditions, which explain how we handle your data')}}.
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endguest
@endsection
