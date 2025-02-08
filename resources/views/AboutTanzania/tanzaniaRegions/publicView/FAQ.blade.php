<div class="tab-pane fade" id="nav-FAQ" role="tabpanel" aria-labelledby="nav-FAQ-tab">
    <div class="card">
        <div class="card-body" style="background-color: rgba(255,255,255,0.85);">
            <a href="#" class="btn btn-primary btn-sm float-end">Ask Question &blacktriangleright;</a>
            <br>
            <div class="col-md-12 mt-3">
                <div class="accordion" id="accordion">
                    @forelse ($tanzaniaRegionsFAQ as $index => $tanzaniaRegionFAQ)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{$index}}">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDescription{{$index}}" aria-expanded="true" aria-controls="collapseDescription{{$index}}">
                                    <strong>{{ $tanzaniaRegionFAQ->question_title }}</strong> &blacktriangledown;
                                </button>
                            </h2>
                            <div id="collapseDescription{{$index}}" class="accordion-collapse collapse" aria-labelledby="heading{{$index}}" data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    {{ $tanzaniaRegionFAQ->question_answer }}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-info" role="alert">
                            No Frequently Asked Questions Available. Begin your curiosity by emailing us your question. We value your privacy and assure you that we won't share your contact information with anyone or any third-party software.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
