@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <a class="btn btn-block btn-primary" href="/usuarios"><i class="fa fa-users"></i> {{ $clientes->count() }} Usuarios</a>
                    <hr>
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Produtos cadastrados - {{ $produtos->count() }}
                        </div>
                        <div class="panel-body">
                            <a class="btn btn-info" href="/produtos"><i class="fa fa-users"></i> Ver Produtos</a>

                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Vendidos</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($produtos as $produto)
                                        <tr>
                                            <th>{{ $produto->name }}</th><td>{{ $produto->pedidos->sum('quantidade') }}</td>
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <a class="btn btn-block btn-warning" href="/pedidos"><i class="fa fa-users"></i> {{ $pedidos->count() }} Pedidos</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
