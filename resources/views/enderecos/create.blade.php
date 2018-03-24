@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Create New Produto</div>
                    <div class="panel-body">
                        <a href="{{ url('/produtos') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        @if(isset($endereco))

                        @else

                        <form method="POST" action="{{ url('/produtos') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                        @endif


                            <!-- Nome -->
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
                                <div class="col-md-6">
                                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <!-- Nome -->
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
                                <div class="col-md-6">
                                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <!-- Nome -->
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
                                <div class="col-md-6">
                                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
