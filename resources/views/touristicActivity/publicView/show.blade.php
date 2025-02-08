@extends('layouts.main', [
    'title' => __('Activity - ' . $touristicActivity->activity_name),
    'header' => __('Activity - ' . $touristicActivity->activity_name),
])

@include('includes.validate_assets')

@section('content')

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-lg">
                        <div class="card-body bg-white bg-opacity-85">
                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="card-header bg-primary text-white py-3">
                                        <h2 class="mb-2 fs-3">
                                            {{ $touristicActivity->activity_name }} 
                                        </h2>
                                        <p class="text-warning fst-italic mb-0 fs-6">
                                            "Exploration enthusiasts, Travel on a {{$touristicActivity->activity_name}} for an incredible memory."
                                        </p>
                                    </div>
                                </div>
                            </div> 
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <div class="card shadow-sm p-3">
                                        <img 
                                        src="{{ asset('public/touristicActivityImage/' . $touristicActivity->activity_image) }}"
                                        alt="{{ $touristicActivity->activity_name }}"
                                        class="card-img-top group-travel-image"
                                        loading="lazy"
                                    >
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="card shadow-sm p-3">
                                        <h4 class="mb-2 text-primary" style="font-size: 20px">{{ $touristicActivity->activity_name }} Overview</h4>
                                        <p class="text-muted">{{ $touristicActivity->activity_description }}</p>
                                        <span>{{ $touristicActivity->basic_information }}</span>
                                    </div>
                            
                                    <div class="card shadow-sm p-3">
                                        <h4 class="mb-2 text-primary" style="font-size: 20px">{{ $touristicActivity->activity_name }} Conducting Tips</h4>
                                        @forelse ($touristicActivityTips as $touristicActivityTip)
                                            <ul class="list-unstyled">
                                                <li class="mb-2">
                                                    <strong class="text-success">&rightarrow; {{ $touristicActivityTip->tip_name }}</strong>  <br>
                                                    <span class="text-muted mb-0">{{ $touristicActivityTip->tip_description }}</span>
                                                </li>
                                            </ul>
                                        @empty
                                            <p class="text-danger">No tips were added!</p>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
    @endsection
