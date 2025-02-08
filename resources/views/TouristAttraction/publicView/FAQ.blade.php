<div class="tab-pane fade" id="nav-FAQ" role="tabpanel" aria-labelledby="nav-FAQ-tab">
    <div class="row mt-4">
        <div class="col-md-12 text-end mb-3">
            <a href="#" class="btn btn-link text-decoration-none text-primary">Ask a Question &blacktriangleright;</a>
        </div>
        <div class="col-md-10 offset-md-1">
            <div class="accordion" id="faqAccordion">
                @forelse ($touristicAttractionsFaq as $index => $touristicAttractionFaq)
                    <div class="accordion-item mb-2 border-0 shadow-sm">
                        <h2 class="accordion-header" id="heading{{ $index }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="false" aria-controls="collapse{{ $index }}">
                                <i class="fas fa-question-circle text-primary me-2"></i> {{ $touristicAttractionFaq->question_title }}
                            </button>
                        </h2>
                        <div id="collapse{{ $index }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $index }}" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                {{ $touristicAttractionFaq->question_description }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info" role="alert">
                        No Frequently Asked Questions available. Start your curiosity by emailing us your question. We value your privacy and assure you that we won’t share your contact information with anyone or any third-party software.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
