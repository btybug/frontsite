@extends('btybug::layouts.admin')
@section('content')
    {!! Form::open() !!}
    <div class="row menu-container">
        <div class="col-md-6">
            <a href="{!! url('admin/console/structure/menus?p='.$menu->id) !!}" class="btn btn-info">Back</a>
        </div>
        <div class="col-md-3">
            <h2 class="m-t-0">{{ '' }} Menu</h2>
        </div>
        <div class="col-md-3">
            {!! Form::submit('Save',['class' => 'btn btn-primary']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 right">
        <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-3 col-lg-3 col-xl-3">
                <div class="panel panel-default">
                    <div class="panel-heading bg-black-darker text-white">
                        <a class="accordion-toggle  pull-right m-r-10" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" >
                            <span class="icon"><i class="fa fa-chevron-down" aria-hidden="true"></i></span>
                        </a>
                        Front Pages
                    </div>
                    <div class="panel-body collapse" id="collapseOne">
                        <ol id="sortable1" class="dropfalse sortable sortable-mimheight">
                       {!! hierarchyFrontendPagesListWithModuleName($pageGrouped) !!}
                        </ol>
                    </div>
                </div>

            </div>
            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-9 col-xl-9">
                <div class="panel panel-default">
                    <div class="panel-heading bg-black-darker text-white"><a href="/admin/frontend/menu/menufile/menu"
                                                                             class="btn btn-default btn-xs pull-right"
                                                                             data-download="json"
                                                                             download="menujson.json">Download</a>
                        <a href="#" class="btn btn-default btn-xs pull-right m-r-10" data-preview="menu">Preview</a>
                        Menu
                        Item
                    </div>
                    <div class="panel-body">
                        <ol id="sortable2" data-menulist="dropnew" class="dropfalse sortable connectedSortable sortable-mimheight">

                        </ol>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- Item template used by JS -->
    <script type="template" id="item-template">
        <li data-details='[serialized_data]' [class]>
            <div class="drag-handle not-selected">
                [title]
                <div class="item-actions" style="display: block;">
                    <a href="#" class="view-url"><i class="fa fa-cog"></i></a>
                    <a href="javascript:;" data-action="Collapse">
                        <i class="fa fa-arrow-down"></i> Collapse
                    </a>
                    <a href="javascript:;" data-action="delete"><i class="fa fa-trash-o"></i> Remove</a>
                </div>
                <div data-collapse="edit" class="collapse">ddf</div>
            </div>
            <ol></ol>
        </li>
    </script>
    <!-- END Item template -->
    <script type="template" id="new-menu-item">
        <!-- Save Status -->
        <input type="hidden" name="save_state" value="add"/>
        <form id="new-item-form">
            <input type="hidden" name="parent_id" value="0"/>
            <input type="hidden" name="item_id" value="0"/>
            <input type="hidden" name="menus_id" value=""/>
            <input type="text" class="hide" name="link_type" value=""/>
            <input type="text" class="hide" name="pagegroup" value=""/>
            <input type="text" class="hide" name="groupItem" value=""/>
            <div class="panel panel-default m-b-0">
                <div class="panel-body form-horizontal">
                    <div data-optionfilter="heading" class="form-group text-center">
                        <p>This is Dynamic Item Group. All of the items under this group will be displayed in
                            the menu, this will include any new item added automatically</p>
                    </div>
                    <div class="form-group" data-optionfilter="notheading">
                        <label for="edittext" class="col-sm-4 control-label">Item Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="edittext" placeholder="Text"
                                   name="title">
                        </div>
                    </div>
                    <div class="form-group" data-optionfilter="notheading">
                        <label for="editcustom-link" class="col-sm-4 control-label">Item URL</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="editcustom-link"
                                   placeholder="http://www.example.com/home" name="url" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="editclass" class="col-sm-4 control-label">Apply different Item class</label>
                        <div class="col-sm-8">
                            <input type="checkbox" name="hasclass" value="1">
                        </div>
                    </div>

                    <div class="form-group hide" data-showhide="hasclass">
                        <label for="editclass" class="col-sm-4 control-label">Item class</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="editclass" name="class">
                                <option value="">Select Class</option>
                                <option value="item_class_1">Item Class 1</option>
                                <option value="item_class_2">Item Class 2</option>
                                <option value="item_class_3">Item Class 3</option>
                            </select>

                        </div>
                    </div>

                    <div class="form-group" data-optionfilter="notheading">
                        <label class="col-sm-4 control-label" for="editicon">Icon</label>
                        <div class="col-sm-8 removeindent">
                            <a href="#" class="btn btn-default btn-sm" data-icon="iconbutton">Select Icon</a>
                            <span class="iconView" data-iconSeting="">No Icon</span>
                            <input type="text" name="icon" class="geticonseting">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="editopenNewtab"></label>
                        <div class=" col-sm-8">
                            <input type="checkbox" id="editopenNewtab" name="new_link">
                            Open in new Tab?
                        </div>
                    </div>

                    <p class="text-right p-r-15">
                        <button type="button" class="btn btn-success save-item">Save</button>
                        <button type="button" class="btn btn-default" data-action="cancel">Cancel</button>
                    </p>
                </div>
            </div>
        </form>
    </script>
    {{--{!! Form::textarea('json_data',$data,['data-export' => "json"]) !!}--}}
    <input name="html_data" data-export="html" class="" value=''>
    <input name="id" data-export="ID" type="hidden" value=''>
    {!! Form::close() !!}
@stop
{{--@include('tools::common_inc')--}}
@section('CSS')
    {!! HTML::style('public/css/create_pages.css') !!}
    {!! HTML::style('public/css/menu.css?v=0.16') !!}
    {!! HTML::style('public/css/tool-css.css?v=0.23') !!}
    {!! HTML::style('public/css/page.css?v=0.15') !!}
    {!! HTML::style('public/css/admin_pages.css') !!}
    <style>
        .page_labels {
            overflow: hidden;
            text-overflow: ellipsis;
            margin: 10px 0 2px 15px;
            background: #e8e7e7;
            padding: 4px 13px;
            border: 1px solid #d6d2d2;
            font-size: 15px;
        }
        #sortable1 ,#sortable2 {
            border: 1px solid #eee;
            width: 160px;
            list-style-type: none;
            margin: 0;
            padding: 5px 0 0 0;
            float: left;
            margin-right: 10px;
        }
        #sortable1 li,#sortable2 li {
            font-size: 1.2em;
            width: 157px;
        }

        ol#sortable1 button, ol#sortable1 a ,ol#sortable2 button,ol#sortable2 a {
            display: none;
        }
        .delete-menu:active{
            color: red;
            font-size: 1em;
        }
    </style>
@stop

@section('JS')
    {!! HTML::script('public/js/create_pages.js') !!}
    {!! HTML::script("public/js/UiElements/bb_styles.js?v.5") !!}
    {!! HTML::script('public/js/admin_pages.js') !!}
    <script>

        $(document).ready(function () {

            $( "#sortable1, #sortable2" ).sortable({
                connectWith: ".connectedSortable",
                remove: function (event, ui) {
                    var current=ui.item.clone();
                    var timeInMs = Date.now();
                    current.addClass('delete-'+timeInMs);
                    current.find('.listinginfo').append(
                        '<i class="fa fa-pencil" data-edit='+timeInMs+' aria-hidden="true"></i>'+
                        '<i class="fa fa-minus" data-colspan='+timeInMs+' aria-hidden="true"></i>' +
                        '<i class="fa fa-times delete-menu" data-container='+timeInMs+' aria-hidden="true"></i>');
                    current.appendTo('#sortable2');
                    $(this).sortable('cancel');
                }
            }).disableSelection();
            $('body').on('click','.delete-menu',function () {
                console.log(1);
                var className='.delete-'+$(this).attr('data-container');
                $(className).remove();
            });
        });
    </script>
@stop