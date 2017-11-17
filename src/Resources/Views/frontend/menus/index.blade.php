@extends('btybug::layouts.mTabs',['index'=>'frontend_manage'])
@section('tab')
    {!! HTML::style('public/css/new-store.css') !!}
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h3 class="menuText f-s-17 hide">
            <span class="module_icon_main"></span>
            <span class="module_icon_main_text">Menus</span>
        </h3>
        <a href="#" class="btn btn-danger pull-right create-new"><i class="fa fa-plus"></i></a>
        <button class="btn btn-sm pull-right btnUploadWidgets" type="button" data-toggle="modal"
                data-target="#uploadfile">
            <i class="fa fa-cloud-upload module_upload_icon"></i> <span
                    class="upload_module_text">Upload Menus</span>
        </button>


        <div class="row">
            <table class="table table-bordered" id="tpl-table">
                <thead>
                <tr class="bg-black-darker text-white">
                    <th> Name</th>
                    <th> Author</th>
                    <th> Type</th>
                    <th> Created Date</th>
                    <th width="15%"> Action</th>
                </tr>
                </thead>
                <tfoot>
                @if(count($menus))
                    @foreach($menus as $menu)
                        <tr>
                            <th> {!! $menu->name !!}</th>
                            <th> {!! BBGetUserName($menu->creator_id) !!}</th>
                            <th> {{ $menu->type }}</th>
                            <th> {!! BBgetDateFormat($menu->created_at) !!}</th>
                            <th width="15%">
                                @if($menu && $menu->type == 'custom')
                                    <a data-href="{!! url('/admin/console/structure/menus/delete') !!}"
                                           data-type="Menu"
                                           data-key="{!! $menu->id !!}" class="btn btn-danger trashBtn delete-button"><i
                                                    class="fa fa-trash-o"></i></a>
                                @endif
                                <a href="#" class="btn btn-primary"><i class="fa fa-clone"></i></a>
                                <a href="{!! route('edit_front_menu',$menu->id) !!}" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                            </th>
                        </tr>
                    @endforeach
                @else
                    NO Menus
                @endif
                </tfoot>
            </table>
        </div>
    </div>


    {{--<div class="templates-list  m-t-20 m-b-10">--}}
    {{--<div class="row m-b-10">--}}
    {{--{!! HTML::image('images/ajax-loader5.gif', 'a picture', array('class' => 'thumb img-loader hide')) !!}--}}
    {{--<div class="raw tpl-list">--}}
    {{--@include('console::structure._partials.menu_roles')--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}


    <div class="modal fade" id="uploadfile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Upload</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url'=>'/admin/uploads/units/upload-unit','class'=>'dropzone', 'id'=>'my-awesome-dropzone']) !!}
                    {!! Form::hidden('data_type','files',['id'=>"dropzone_hiiden_data"]) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="createNew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Create Menu</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url'=>'/admin/front-site/structure/menus/create','class'=>'form-horizontal']) !!}
                    <fieldset>
                        <!-- Form Name -->
                        <legend>Menu</legend>
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput">Name</label>
                            <div class="col-md-4">
                                {!! Form::text('name',null,['class' => 'form-control input-md']) !!}
                                <span class="help-block">enter your menu name</span>
                            </div>
                        </div>
                        <!-- Button (Double) -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="button1id"></label>
                            <div class="col-md-8">
                                {!! Form::submit('Save',['class' => 'btn btn-success']) !!}
                            </div>
                        </div>
                    </fieldset>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    @include('btybug::_partials.delete_modal')
@stop
@section('CSS')
    {!! HTML::style('public/js/bootstrap-select/css/bootstrap-select.min.css') !!}
    <style>
        .child-tpl {
            width: 95% !important;
        }

        .img-loader {
            width: 70px;
            height: 70px;
            position: absolute;
            top: 50px;
            left: 40%;
        }

    </style>
@stop
@section('JS')
    {!! HTML::script('public/js/dropzone/js/dropzone.js') !!}
    {!! HTML::script('public/js/bootstrap-select/js/bootstrap-select.min.js') !!}
    <script>
        Dropzone.options.myAwesomeDropzone = {
            init: function () {
                this.on("success", function (file) {
                    location.reload();

                });
            }
        };

        $(document).ready(function () {
            $('body').on("click", ".create-new", function () {
                $("#createNew").modal();
            });

            $('body').on("change", ".select-type", function () {
                var val = $(this).val();
                var url = window.location.pathname + "?type=" + val;

                window.location = url;
            });

            $('.rightButtons a').click(function (e) {
                e.preventDefault();
                $(this).addClass('active').siblings().removeClass('active');
            });

            $('.btnListView').click(function (e) {
                e.preventDefault();
                $('#viewType').addClass('listView');
            });

            $('.btnGridView').click(function (e) {
                e.preventDefault();
                $('#viewType').removeClass('listView');
            });


            $('.selectpicker').selectpicker();

            var p = "{!! $_GET['p'] or null !!}";

            if (p.length) {
                $("a[main-type=" + p + "]").click();
            }

        });

    </script>
@stop