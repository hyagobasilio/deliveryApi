@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">usuario {{ $usuario->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/usuarios') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/usuarios/' . $usuario->id . '/edit') }}" title="Edit usuario"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['usuarios', $usuario->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete usuario',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $usuario->id }}</td>
                                    </tr>
                                    <tr><th> Name </th><td> {{ $usuario->name }} </td>
                                    </tr><tr><th> Email </th><td> {{ $usuario->email }} </td></tr>
                                </tr><tr><th> Telefone </th><td> {{ $usuario->telefone }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Endereços</div>
                    <a href="/enderecos/create?user_id={{$usuario->id}}"></a>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <th>Endereço</th>
                                    <th>Ações</th>
                                </thead>
                                <tbody>
                                    @foreach($usuario->enderecos as $endereco)
                                    <tr>
                                        <td>{{ $endereco->rua }} - {{ $endereco->numero }}
                                         {{ $endereco->complemento }}, {{ $endereco->cidade }}</td>
                                        <td>
                                            <a href="/enderecos/{{$endereco->id}}/edit" >Editar</a>
                                            <a href="/enderecos/{{$endereco->id}}/edit" >Deletar</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
