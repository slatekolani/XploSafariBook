@extends('layouts.main', ['title' => 'Frequently Asked Questions', 'header' => 'Frequently Asked Questions'])
@include('includes.validate_assets')

@section('content')

    <div class="col-md-12">
        <div class="row" style="margin-top: 5px">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-body" style="background-color: rgba(255,255,255,0.85)">
                        <a href="#" class="pull-right">Ask Question &blacktriangleright;</a>
                        <div class="col-md-10" style="margin-top: 10px">
                                <div class="panel-group" id="accordion">
                                    @forelse ($platformFaqs as $index => $platformFaq)
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseDescription{{$index}}" style="font-size: 14px">{{$platformFaq->question_title}}</a>
                                                </h4>
                                            </div>
                                            <div id="collapseDescription{{$index}}" class="panel-collapse collapse in">
                                                <div class="panel-body">{{$platformFaq->question_description}}</div>
                                            </div>
                                        </div>
                                    @empty
                                        <p>No Frequently Asked Questions Available. Begin your curiosity by emailing us your question. We value your privacy and assure you that we won't share the contact information with anyone or any third-party software</p>
                                    @endforelse
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


