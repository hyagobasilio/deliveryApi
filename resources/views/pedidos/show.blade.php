@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">pedido {{ $pedido->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/pedidos') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/pedidos/' . $pedido->id . '/edit') }}" title="Edit pedido"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['pedidos', $pedido->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete pedido',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <td>{{ $pedido->id }}</td>
                                    </tr>
                                    <tr>
                                        <th> Endereco </th>
                                        <td> {{ $pedido->endereco }} </td>
                                    </tr>
                                    <tr>
                                        <th> Numero </th>
                                        <td> {{ $pedido->numero }} </td>
                                    </tr>
                                    <tr>
                                        <th> Complemento </th>
                                        <td> {{ $pedido->complemento }} </td>
                                    </tr>
                                    <tr>
                                        <th> Bairro </th>
                                        <td> {{ $pedido->bairro }} </td>
                                    </tr>
                                    <tr>
                                        <th> Forma de Pagamento </th>
                                        <td> {{ $pedido->forma_pagamento }} </td>
                                    </tr>
                                    <tr>
                                        <th> Troco para</th>
                                        <td> R$ {{ $pedido->troco }} </td>
                                    </tr>
                                    <tr>
                                        <th>Total Pedido</th>
                                        <td>  <strong>R$  {{ $pedido->totalPedido() }}</strong> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <h2>Itens do Pedido</h2>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Produto</th>
                                        <th>Preço</th>
                                        <th>Quantidade</th>
                                        <th>Total</th>
                                        <th>Observacao</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($pedido->itens->all() as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->produto->name }}</td>
                                        <td>{{ $item->produto->price }}</td>
                                        <td>{{ $item->quantidade }}</td>
                                        <td>{{ $item->totalItem() }}</td>
                                        <td>{{ $item->observacao }}</td>
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
