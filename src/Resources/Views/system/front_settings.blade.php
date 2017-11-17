@extends('btybug::layouts.mTabs',['index'=>'manage_settings'])
@section('tab')
    <div class="col-md-12">
        {!! Form::model($model,['class' => 'form-horizontal','files' => true,'url'=>route('post_font_site_settings_frontrnd')]) !!}
        <div class="panel panel-default">
            <div class="panel-heading">JS Settings</div>
            <div class="panel-body">

                <fieldset>
                    <!-- Multiple Radios (inline) -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="radios">Active JS</label>
                        <div class="col-md-8">
                            front.js
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="radios">Select JS</label>
                        <div class="col-md-8">
                            {!! Form::select('js_data[]',$jsData,null,
                                ['class' => 'form-control pull-right select-dropdowns','multiple' => 'multiple']) !!}
                        </div>
                    </div>
                    <div class="col-md-12">
                        {!! Form::submit('Save',['class' => 'btn btn-primary pull-right']) !!}
                    </div>
                </fieldset>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Css Settings</div>
            <div class="panel-body">
                <fieldset>
                    <!-- Multiple Radios (inline) -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="radios">Select Css</label>
                        <div class="col-md-8">
                            {!! Form::select('css_version[]',$cssData,null,
                            ['class' => 'form-control select-dropdowns pull-right','multiple' => 'multiple']) !!}
                        </div>
                    </div>
                    <div class="col-md-12">
                        {!! Form::submit('Save',['class' => 'btn btn-primary pull-right']) !!}
                    </div>
                </fieldset>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Font Settings</div>
            <div class="panel-body">

                <fieldset>
                    <!-- Multiple Radios (inline) -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="radios">Select Font</label>
                        <div class="col-md-8">
                            {!! Form::select('font_version',
                            ['' => 'Select Font'],null,['class' => 'form-control pull-right']) !!}
                        </div>
                    </div>
                    <div class="col-md-12">
                        {!! Form::submit('Save',['class' => 'btn btn-primary pull-right']) !!}
                    </div>
                </fieldset>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@stop
@section('CSS')
    {!! HTML::style("public/css/select2/select2.min.css") !!}
@stop
@section('JS')
    {!! HTML::script("public/js/select2/select2.full.min.js") !!}
    <script>
       $(document).ready(function () {
           $('.select-dropdowns').select2({
               placeholder: 'Select versions'
           });
       })
    </script>
@stop