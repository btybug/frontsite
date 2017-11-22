@extends('btybug::layouts.admin')
@section('content')
    {!! Form::model($menu,['id' => 'menu-save']) !!}
    {!! Form::hidden('id',null) !!}
    <div class="bb-menu-container">
        <div class="container-fluid">
            <!-- Settings -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading menu-panel">
                            <h3 class="panel-title pull-left">
                                <label>{!! $menu->name !!}</label>
                                {!! Form::text('name',null,['class' => 'menu-name-field']) !!}
                            </h3>

                            <div class="pull-right">
                                <a href="javascript:" class="btn btn-warning btn-sm bb-menu-settings">
                                    <i class="fa fa-cog"></i>
                                </a>
                                {!! Form::submit('Save',['class' => 'btn btn-primary btn-sm bb-menu-save']) !!}
                                <a href="javascript:" class="btn btn-success btn-sm">Preview</a>
                            </div>
                        </div>

                        <div class="panel-body general-menu-settings">
                            <div class="bb-menu-form">
                                <div class="row">
                                    <div class="col-md-5">
                                        <label class="text-primary">How menu display for different visitors
                                            types?</label>

                                        <p>
                                            <a href="javascript:" class="btn btn-xs btn-danger bb-bulk-roles"
                                               data-bulk="hide">Hide for all</a>
                                            <a href="javascript:" class="btn btn-xs btn-success bb-bulk-roles"
                                               data-bulk="show">Show for all</a>
                                            <a href="javascript:" class="btn btn-xs btn-primary bb-bulk-roles"
                                               data-bulk="members">Show for members</a>
                                        </p>

                                        <div class="form-group has-feedback">
                                            <label>Filter roles</label>
                                            <input type="text" class="form-control" id="bb-role-filter"
                                                   placeholder="Type search keyword">
                                            <span class="glyphicon glyphicon-search form-control-feedback"></span>
                                        </div>

                                        <ul class="list-group bb-roles-list">
                                            <li class="list-group-item" data-role="guests" data-title="Guests"
                                                data-display="show">
                                                <span class="bb-role-title">Guests</span>

                                                <a href="javascript:" class="pull-right text-info bb-what-to-show">
                                                    <i class="fa fa-chevron-right"></i>
                                                </a>

                                                <div class="pull-right">
                                                    <input type="checkbox" class="bb-switch bb-role-toggle" checked
                                                           name="guests">
                                                </div>
                                            </li>
                                            <li class="list-group-item" data-role="normal-user" data-title="Normal User"
                                                data-display="show">
                                                <span class="bb-role-title">Normal User</span>

                                                <a href="javascript:" class="pull-right text-info bb-what-to-show">
                                                    <i class="fa fa-chevron-right"></i>
                                                </a>

                                                <div class="pull-right">
                                                    <input type="checkbox" class="bb-switch bb-role-toggle" checked
                                                           name="normal-user">
                                                </div>
                                            </li>
                                            <li class="list-group-item" data-role="pro-user" data-title="Pro User"
                                                data-display="show">
                                                <span class="bb-role-title">Pro User</span>

                                                <a href="javascript:" class="pull-right text-info bb-what-to-show">
                                                    <i class="fa fa-chevron-right"></i>
                                                </a>

                                                <div class="pull-right">
                                                    <input type="checkbox" class="bb-switch bb-role-toggle" checked
                                                           name="pro-user">
                                                </div>
                                            </li>
                                            <li class="list-group-item" data-role="editor" data-title="Editor"
                                                data-display="show">
                                                <span class="bb-role-title">Editor</span>

                                                <a href="javascript:" class="pull-right text-info bb-what-to-show">
                                                    <i class="fa fa-chevron-right"></i>
                                                </a>

                                                <div class="pull-right">
                                                    <input type="checkbox" class="bb-switch bb-role-toggle" checked
                                                           name="editor">
                                                </div>
                                            </li>
                                            <li class="list-group-item" data-role="contributor" data-title="Contributor"
                                                data-display="show">
                                                <span class="bb-role-title">Contributor</span>

                                                <a href="javascript:" class="pull-right text-info bb-what-to-show">
                                                    <i class="fa fa-chevron-right"></i>
                                                </a>

                                                <div class="pull-right">
                                                    <input type="checkbox" class="bb-switch bb-role-toggle" checked
                                                           name="contributor">
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="what-to-show-panel hide" data-for="guests">
                                            <div class="form-group">
                                                <label>What to show for "Guests" role?</label>
                                                <select name="guests_show" class="form-control input-sm">
                                                    <option value="hide">Hide Only</option>
                                                    <option value="unit">Render Unit</option>
                                                    <option value="menu">Render another menu</option>
                                                </select>
                                            </div>

                                            <div class="form-group hide" data-render="unit">
                                                <label>Select unit</label>
                                                <button class="btn btn-primary form-control">BB Button for units
                                                </button>
                                            </div>

                                            <div class="form-group hide" data-render="menu">
                                                <label>Select menu</label>
                                                <button class="btn btn-info form-control">BB Button for menus</button>
                                            </div>
                                        </div>
                                        <div class="what-to-show-panel hide" data-for="normal-user">
                                            <div class="form-group">
                                                <label>What to show for "Normal User" role?</label>
                                                <select name="normal-user_show" class="form-control input-sm">
                                                    <option value="hide">Hide Only</option>
                                                    <option value="unit">Render Unit</option>
                                                    <option value="menu">Render another menu</option>
                                                </select>
                                            </div>

                                            <div class="form-group hide" data-render="unit">
                                                <label>Select unit</label>
                                                <button class="btn btn-primary form-control">BB Button for units
                                                </button>
                                            </div>

                                            <div class="form-group hide" data-render="menu">
                                                <label>Select menu</label>
                                                <button class="btn btn-info form-control">BB Button for menus</button>
                                            </div>
                                        </div>
                                        <div class="what-to-show-panel hide" data-for="pro-user">
                                            <div class="form-group">
                                                <label>What to show for "Pro User" role?</label>
                                                <select name="pro-user_show" class="form-control input-sm">
                                                    <option value="hide">Hide Only</option>
                                                    <option value="unit">Render Unit</option>
                                                    <option value="menu">Render another menu</option>
                                                </select>
                                            </div>

                                            <div class="form-group hide" data-render="unit">
                                                <label>Select unit</label>
                                                <button class="btn btn-primary form-control">BB Button for units
                                                </button>
                                            </div>

                                            <div class="form-group hide" data-render="menu">
                                                <label>Select menu</label>
                                                <button class="btn btn-info form-control">BB Button for menus</button>
                                            </div>
                                        </div>
                                        <div class="what-to-show-panel hide" data-for="editor">
                                            <div class="form-group">
                                                <label>What to show for "Editor" role?</label>
                                                <select name="editor_show" class="form-control input-sm">
                                                    <option value="hide">Hide Only</option>
                                                    <option value="unit">Render Unit</option>
                                                    <option value="menu">Render another menu</option>
                                                </select>
                                            </div>

                                            <div class="form-group hide" data-render="unit">
                                                <label>Select unit</label>
                                                <button class="btn btn-primary form-control">BB Button for units
                                                </button>
                                            </div>

                                            <div class="form-group hide" data-render="menu">
                                                <label>Select menu</label>
                                                <button class="btn btn-info form-control">BB Button for menus</button>
                                            </div>
                                        </div>
                                        <div class="what-to-show-panel hide" data-for="contributor">
                                            <div class="form-group">
                                                <label>What to show for "Contributor" role?</label>
                                                <select name="contributor_show" class="form-control input-sm">
                                                    <option value="hide">Hide Only</option>
                                                    <option value="unit">Render Unit</option>
                                                    <option value="menu">Render another menu</option>
                                                </select>
                                            </div>

                                            <div class="form-group hide" data-render="unit">
                                                <label>Select unit</label>
                                                <button class="btn btn-primary form-control">BB Button for units
                                                </button>
                                            </div>

                                            <div class="form-group hide" data-render="menu">
                                                <label>Select menu</label>
                                                <button class="btn btn-info form-control">BB Button for menus</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Menu -->
            <div class="row">
                <div class="col-md-4">
                    <div data-placement="inline" class="icp icp-auto"></div>
                    <ol class="bb-sortable-static bb-sortable-group">
                        <li data-id="frontend-pages" id="menu-item-front" class="no-nest">
                            <div class="panel panel-default">
                                <div class="bb-menu-item-title">
                                    <i></i>
                                    <strong>Frontend Pages</strong>

                                    <div class="bb-menu-actions pull-right">
                                        <a href="javascript:" class="bb-menu-delete">
                                            <i class="fa fa-close"></i>
                                        </a>
                                        <a href="javascript:" class="bb-menu-collapse expand group-expander">
                                            <i class="fa fa-caret-up"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="panel-body bb-menu-group-body">
                                    <ol class="bb-sortable-static">
                                    {!! renderFrontPagesInMenu($pageGrouped,true) !!}
                                    </ol>
                                </div>
                            </div>
                        </li>
                    </ol>
                    {!! Form::textarea('json_data',null,['id' => 'log','placeholder' => 'JSON LOG', 'class' => 'form-control','rows' => 15]) !!}
                </div>
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            @if($menu->json_data)
                            <ol class="bb-menu-area">{!! renderSavedPagesInMenu(json_decode($menu->json_data,true),false) !!}</ol>
                            @else
                                <ol class="bb-menu-area"></ol>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@stop
{{--@include('tools::common_inc')--}}
@section('CSS')
    {!! HTML::style('public/css/bootstrap/css/bootstrap-switch.min.css') !!}
    {!! HTML::style('public/css/font-awesome/css/fontawesome-iconpicker.min.css') !!}
    {!! HTML::style('public/css/menus.css?v='.rand(1111,9999)) !!}

@stop

@section('JS')
    {!! HTML::script('public/js/jquery.mjs.nestedSortable.js') !!}
    {!! HTML::script('public/css/bootstrap/js/bootstrap-switch.min.js') !!}
    {!! HTML::script('public/css/font-awesome/js/fontawesome-iconpicker.min.js') !!}
    {!! HTML::script('public/js/menus.js') !!}
@stop