@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <a class="btn btn-block btn-primary" href="/usuarios"><i class="fa fa-users"></i>{{ 5 }} Usuarios</a>
                    <a class="btn btn-block btn-info" href="/produtos"><i class="fa fa-users"></i> {{ 10}} Produtos</a>
                    <a class="btn btn-block btn-warning" href="/pedidos"><i class="fa fa-users"></i> {{ 10}} Pedidos</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
