@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('admin.sidebar')

        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">Edit usuario #{{ $usuario->id }}</div>
                <div class="panel-body">
                    <a href="{{ url('/usuarios') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <br />
                    <br />

                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif

                    {!! Form::model($usuario, [
                        'method' => 'PATCH',
                        'url' => ['/usuarios', $usuario->id],
                        'class' => 'form-horizontal',
                        'files' => true
                        ]) !!}

                        @include ('usuarios.form', ['submitButtonText' => 'Update'])

                        {!! Form::close() !!}

                    </div>
                </div>

                <div class="panel panel-info">
                    <div class="panel-heading">Adicionar endereço</div>
                   <div class="panel-body">
                    {!! Form::open(['url' => '/enderecos', 'class' => 'form-vertical', 'files' => true]) !!}
                    {!! Form::hidden('user_id', $usuario->id) !!}

                    <div class="form-group {{ $errors->has('rua') ? 'has-error' : ''}}">
                        {!! Form::label('rua', 'Rua\Av.', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('rua', null, ['class' => 'form-control', 'placeholder' => 'Rua\Av.']) !!}
                            {!! $errors->first('rua', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('numero') ? 'has-error' : ''}}">
                        {!! Form::label('numero', 'Número', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('numero', null, ['class' => 'form-control', 'placeholder' => 'Número']) !!}
                            {!! $errors->first('numero', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('bairro') ? 'has-error' : ''}}">
                        {!! Form::label('bairro', 'Bairro', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('bairro', null, ['class' => 'form-control', 'placeholder' => 'Bairro']) !!}
                            {!! $errors->first('bairro', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('complemento') ? 'has-error' : ''}}">
                        {!! Form::label('complemento', 'Complemento', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('complemento', null, ['class' => 'form-control', 'placeholder' => 'Complemento']) !!}
                            {!! $errors->first('complemento', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('cidade') ? 'has-error' : ''}}">
                        {!! Form::label('cidade', 'Cidade', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('cidade', null, ['class' => 'form-control', 'placeholder' => 'Cidade']) !!}
                            {!! $errors->first('cidade', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-4 col-md-4">
                            {!! Form::submit('Adicionar', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}


                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Endereço</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($usuario->enderecos as $item)
                            <tr>
                                <td>{{ $loop->iteration or $item->id }}</td>
                                <td>
                                    {{ $item->rua }} {{ $item->numero }}, {{ $item->complemento }} {{ $item->bairro }} {{ $item->cidade }}
                                </td>
                                <td>
                                    {!! Form::open([
                                        'method'=>'DELETE',
                                        'url' => ['/enderecos', $item->id],
                                        'style' => 'display:inline'
                                        ]) !!}
                                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-xs',
                                        'title' => 'Delete endereço',
                                        'onclick'=>'return confirm("Confirm delete?")'
                                        )) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            
                        </table>
                    </div> <!-- /.panel-body -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
