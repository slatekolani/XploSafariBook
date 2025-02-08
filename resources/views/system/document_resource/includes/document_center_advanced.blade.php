{{--Document center--}}
{{--Variables => allow_edit, $doc_types_attached, $resource--}}



@include('includes/pnotify_assets')

@push('after-styles')

    {{ Html::style(url("vendor/jstree/themes/default/style.css")) }}


    <style>


    </style>

@endpush

<div class = "row">
    {{--<div class="col-md-12">--}}

    <div class="col-md-4">
        <legend>{{ __('label.administrator.system.document.attached') }}

        </legend>

        <div class="row">
            <div class="col-md-12">
                {{--<div class="element-form" >--}}

                {{--<ul>--}}
                @foreach($doc_types_attached as $doc_type)
                    <div id="treeBasic" class="jstree jstree-1 jstree-default" role="tree" aria-multiselectable="true" tabindex="0" aria-activedescendant="j1_7" aria-busy="false">

                        <ul class="jstree-container-ul jstree-children" role="group" >

                            <li  role="treeitem" data-jstree="{ &quot;type&quot; : &quot;folder&quot; }" aria-selected="false" aria-level="2" aria-labelledby="{{ 'j1_3_anchor' . $doc_type->id }}" aria-expanded="true" id="{{ 'j1_3' . $doc_type->id  . ' ' . 'doc' . $doc_type->id }}" class="jstree-node jstree-closed"><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor" href="#" tabindex="-1" id= "{{ 'j1_3_anchor' . $doc_type->id }}" ><i class="jstree-icon jstree-themeicon fas fa-folder jstree-themeicon-custom" role="presentation"></i>
                                    {{ $doc_type->name }}
                                </a>

                                <ul role="group" class="jstree-children ">
                                    {{--document--}}
                                    @foreach($resource->documents()->where('document_id', $doc_type->id)->get() as $doc)
                                        {{--<div class="wf_modules {{ 'wf_group_category'. $wf_module->wfModuleGroup->wf_group_category_id  }}">--}}
                                        <li role="treeitem" aria-selected="false"  data-jstree="{ &quot;type&quot; : &quot;file&quot; }" aria-level="1" aria-labelledby="{{ 'j1_10_anchor' . $doc->pivot->id }}" id= "{{ 'doc' . $doc->pivot->id }}"  class="jstree-node folder jstree-leaf jstree-last "><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor docs" href="#" tabindex="-1" id= "{{ 'doc' . $doc->pivot->id }}"  ><i class="jstree-icon jstree-themeicon fas fa-folder jstree-themeicon-custom" role="presentation"></i>
                                                {{ $doc->pivot->description }}


                                            </a>

                                        </li>
                                    @endforeach
                                </ul>

                            </li>
                        </ul>
                    </div>
                    <br/>
                @endforeach


            </div>
        </div>

    </div>




    <div class="col-md-8">
        <div class = "row">
            <div class="col-md-12">
                {{--Document Preview--}}
                <legend>{{ __('label.administrator.system.document.review') }}
                    @if($allow_edit == 1)
                        |
                        <a  id="edit_doc" class="" style="color:dodgerblue"  href="#">{{ __('label.crud.edit') }}</a>

                    @endif
                </legend>

                {{ Form::hidden('doc_pivot_id', null, ['class' =>'']) }}
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
    {{ Html::script(url("vendor/jstree/jstree.js")) }}
    <script  type="text/javascript">


        $(function () {
            var selected_doc_pivot_id = null;
            $(".search-select").select2();

            $('#treeBasic').jstree({
                'core' : {
                    'themes' : {
                        'responsive': false
                    }
                },
                'types' : {
                    'default' : {
                        'icon' : 'fas fa-boxes',
                    },
                    'folder' : {
                        'icon' : 'fas fa-folder'
                    },
                    'file' : {
                        'icon' : 'fas fa-file'
                    }
                },
                'plugins': ['types']
            });

            /*On select node - Definition*/
            $('#treeBasic').on("select_node.jstree", function (e, data) {
                var $element_id = event.target.id;
                var node_type = $element_id.slice(0,3);
                if(node_type == 'doc'){
                    var doc_pivot_id = $element_id.substring(3);
                    selected_doc_pivot_id = doc_pivot_id;
                    $("#doc_pivot_id").val(doc_pivot_id);
                    let $document_frame = $("#document_frame");
                    get_current_document(doc_pivot_id).done(function ($data) {
                        $document_frame.find("iframe").remove();
                        let $iframe = $('<iframe src="' + $data.url + '" frameborder="0"  width=\'100%\' height=\'600px\'></iframe>');
                        $document_frame.append($iframe);
                    });
                }

            });



            /*Documents which pending to be used list*/
            $("#edit_doc").click(function() {
                edit_document()
            });



            /*Preview document*/
            function get_current_document($doc_pivot_id) {

                return $.ajax({
                    url: base_url + "/admin/document_resource/preview/"+ $doc_pivot_id,
                    dataType : 'json',
                    async : false,
                    method : "GET"
                });
            }


            /*Open edit document page*/
            function edit_document() {
                if(selected_doc_pivot_id != null){
                    window.open(base_url + "/admin/document_resource/edit/" + selected_doc_pivot_id , "_self");
                }else{

                    new PNotify({
                        title: 'Notification',
                        text: '{{ __('alert.system.document.doc_not_selected_for_edit') }}',
                        type: 'error',
                        shadow: true
                    });
                }


            }


        });
    </script>;

@endpush
