@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Pedidos</div>
                    <div class="panel-body">
                        <a href="{{ url('/pedidos/create') }}" class="btn btn-success btn-sm" title="Add New pedido">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        {!! Form::open(['method' => 'GET', 'url' => '/pedidos', 'class' => 'navbar-form navbar-right', 'role' => 'search'])  !!}
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        {!! Form::close() !!}

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Cliente</th>
                                        <th>Status</th>
                                        <th>Endereco</th>
                                        <th>Numero</th>
                                        <th>Total</th>
                                        <th>Bairro</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($pedidos as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td><span class="badge badge-info">Recebido</span></td>
                                        <td>{{ $item->endereco }}</td>
                                        <td>{{ $item->numero }}</td>
                                        <td>{{ $item->totalPedido() }}</td>
                                        <td>{{ $item->bairro }}</td>
                                        <td>
                                            <a href="{{ url('/pedidos/' . $item->id) }}" title="View pedido"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/pedidos/' . $item->id . '/edit') }}" title="Edit pedido"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/pedidos', $item->id],
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
                            </table>
                            <div class="pagination-wrapper"> {!! $pedidos->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
