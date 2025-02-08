{{--Document center--}}
{{--Variables => allow_edit, $docs_attached--}}
<div class = "row">
    {{--<div class="col-md-12">--}}

        <div class="col-md-4">
            <legend>{{ __('label.administrator.system.document.attached') }}

            </legend>

            <div class="row">
                <div class="col-md-12">
                    {{--<div class="element-form" >--}}

                        {{--<ul>--}}
                        @foreach($docs_attached as $doc)
                            {{--<li>--}}
                            <i class="fa fa-file-alt" ></i>
                            <a  style="color:dodgerblue;" class="doc_attached"  href="#" id="{{ 'doc'. $doc->pivot->id }}">{{ $doc->name }}</a>
                            @if($allow_edit == 1)
                                |

                                <a class="" style="color:grey"  href="{{ route('system.document_resource.edit', $doc->pivot->id) }}">{{ __('label.crud.edit') }}</a>
                                {{--<span style="font-size: 12px; color:#414141"> {{   '' . ' : ' . $pollOption->votes  }}   </span>--}}
                                {{--<span style="font-size: 12px; color:#414141"> {{   $pollOption->vote_percent_label  }} </span>--}}
                                {{--</li>--}}
                            @endif
                            <br/>
                        @endforeach
                        {{--</ul>--}}
                    {{--</div>--}}

                </div>
            </div>

        </div>




        <div class="col-md-8">
            <div class = "row">
                <div class="col-md-12">
                    {{--Document Preview--}}
                    <legend>{{ __('label.administrator.system.document.review') }}</legend>
                    <br/>
                    <div id="document_frame" style="text-align: center;">
                        {{--<iframe id="document_preview" name="document_preview" src="" width='100%' height='600px'></iframe>--}}
                    </div>


                </div>

            </div>
        </div>



    {{--</div>--}}
</div>





@push('after-scripts')
    {{ Html::script(asset_url(). "/nextbyte/plugins/select2/js/select2.min.js") }}

    <script  type="text/javascript">


        $(function () {

            $(".search-select").select2();





            /*Documents which pending to be used list*/
            $(".doc_attached").click(function() {
                var $doc_id = this.id;
                var $pivot_id = $doc_id.substr(3);
                let $document_frame = $("#document_frame");
                get_current_document($pivot_id).done(function ($data) {
                    $document_frame.find("iframe").remove();
                    let $iframe = $('<iframe src="' + $data.url + '" frameborder="0"  width=\'100%\' height=\'600px\'></iframe>');
                    $document_frame.append($iframe);
                });
            });



            function get_current_document($doc_pivot_id) {

                return $.ajax({
                    url: base_url + "/admin/document_resource/preview/"+ $doc_pivot_id,
                    dataType : 'json',
                    async : false,
                    method : "GET"
                });
            }


        });
    </script>;

@endpush
