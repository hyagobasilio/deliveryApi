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
                            <form action="">
                                <input type="date" name="data">
                                <button>Filtrar</button>
                            </form>

                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Vendidos</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $total = 0; ?>
                                        @foreach($produtos as $produto)
                                        <?php $total += $produto->totalPedidos(); ?>
                                        <tr>
                                            <th>{{ $produto->name }}</th>
                                            <td>{{ $produto->pedidos()->sum('quantidade') }}</td>
                                            <td>R$ {{ $produto->totalPedidos() }}</td>
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2">Total</td>
                                            <td><strong>{{ $total }}</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    <a class="btn btn-block btn-warning" href="/pedidos"><i class="fa fa-users"></i> {{ $pedidos->count() }} Pedidos</a>

                    @if(Request::has('data'))
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Quem</th>
                                <th>Onde</th>
                                <th>Quanto</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = 0; ?>
                            @foreach($pedidos as $pedido)
                            <?php $total = $pedido->totalPedido(); ?>
                            <tr>
                                <td>{{ $pedido->user->name or '' }}</td>
                                <td>{{ $pedido->endereco }}</td>
                                <td>{{ $pedido->totalPedido() }}</td>
                            </tr>
                            @endforeach
                            <tfoot>
                                <tr>
                                    <td colspan="2">Total</td>
                                    <td>{{ $total }}</td>
                                </tr>
                            </tfoot>
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
