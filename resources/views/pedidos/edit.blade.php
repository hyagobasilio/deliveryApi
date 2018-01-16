@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit pedido #{{ $pedido->id }}</div>
                    <div class="panel-body">
                        <a href="{{ url('/pedidos') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::model($pedido, [
                            'method' => 'PATCH',
                            'url' => ['/pedidos', $pedido->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        @include ('pedidos.form', ['submitButtonText' => 'Update', 'users' => $users])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
            @if(isset($pedido))
            <div class="col-md-9 pull-right">
                <div class="panel panel-default">
                    <div class="panel-heading">Items Pedidos</div>
                    <div class="panel-body">
                        {!! Form::open(['url' => '/itens-pedido', 'class' => 'form-vertical', 'files' => true]) !!}
                        {!! Form::hidden('pedido_id', $pedido->id) !!}

                        <div class="form-group {{ $errors->has('produto_id') ? 'has-error' : ''}}">
                            {!! Form::label('produto_id', 'Produto', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::select('produto_id',$produtos, null, ['class' => 'form-control']) !!}
                                {!! $errors->first('produto_id', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('quantidade') ? 'has-error' : ''}}">
                            {!! Form::label('quantidade', 'Quantidade', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::number('quantidade', null,  ['class' => 'form-control']) !!}
                                {!! $errors->first('quantidade', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('observacao') ? 'has-error' : ''}}">
                            {!! Form::label('observacao', 'Observação', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('observacao', null, ['class' => 'form-control']) !!}
                                {!! $errors->first('observacao', '<p class="help-block">:message</p>') !!}
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
                                    <th>Produto</th>
                                    <th>Preço</th>
                                    <th>Quantidade</th>
                                    <th>Total</th>
                                    <th>Observacao</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($pedido->itens->all() as $item)
                                <tr>
                                    <td>{{ $loop->iteration or $item->id }}</td>
                                    <td>{{ $item->produto->name }}</td>
                                    <td>{{ $item->preco }}</td>
                                    <td>{{ $item->quantidade }}</td>
                                    <td>{{ $item->totalItem() }}</td>
                                    <td>{{ $item->observacao }}</td>
                                    <td>
                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => ['/itens-pedido', $item->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-xs',
                                                    'title' => 'Delete pedido',
                                                    'onclick'=>'return confirm("Confirm delete?")'
                                            )) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>Total</td>
                                    <td colspan="6"><strong>R$ {{ $pedido->totalPedido() }}</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection
