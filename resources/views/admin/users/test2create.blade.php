@extends('layouts.app')

@section('contend')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="#">Users</a>
        </li>
        <li class="breadcrumb-item active">{{trans('admin.new_user')}}</li>
    </ol>
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card border-secondary">
                <div class="card-header border-secondary">
                    <h5 class="card-title"><i class="fa fa-1x fa-plus-square"></i>&nbsp{{trans('admin.new_user')}}</h5>
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => 'user.store', 'class' => 'form-horizontal panel']) !!}
                    <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name']) !!}
                        {!! $errors->first('name', '<small class="form-text text-danger">:message</small>') !!}
                    </div>
                    <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                        {!! $errors->first('name', '<small class="form-text text-danger">:message</small>') !!}
                    </div>

                    <div class="form-group {!! $errors->has('numero') ? 'has-error' : '' !!}">
                        {!! Form::text('numero', null, ['class' => 'form-control', 'placeholder' => 'Number']) !!}
                        {!! $errors->first('numero', '<small class="form-text text-danger">:message</small>') !!}
                    </div>

                    <div class="form-group {!! $errors->has('password') ? 'has-error' : '' !!}">
                        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
                        {!! $errors->first('password', '<small class="form-text text-danger">:message</small>') !!}
                    </div>
                    <div class="form-group">
                        {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Password confirmation']) !!}
                    </div>
                    <div class="form-group">
                        <table class="table">
                            <tr>
                                <td>Admin</td>
                                <td>Project manager</td>
                                <td>Supervisor</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <input type="checkbox" class="toogle-switch" id="admin" name="admin" value="1">
                                        <label for="admin" class="switch_label"></label>
                                    </div>
                                </td>
                                <td><div class="checkbox">
                                        <input type="checkbox" class="toogle-switch" id="cdp" name="cdp" value="1">
                                        <label for="cdp" class="switch_label"></label>
                                    </div></td>
                                <td><div class="checkbox">
                                        <input type="checkbox" class="toogle-switch" id="supervisor" name="supervisor" value="1">
                                        <label for="supervisor" class="switch_label"></label>
                                    </div></td>
                            </tr>
                        </table>

                    </div>
                    {!! Form::submit('Save', ['class' => 'btn btn-primary pull-right']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="row"><br></div>
@endsection