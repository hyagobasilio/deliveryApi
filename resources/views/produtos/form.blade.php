<div class="form-group">
    <label for="name" class="col-md-4 control-label">Foto</label>
    {!! Form::file('photo', array('class' => 'image')) !!}
    {!! $errors->first('photo', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('disponivel') ? 'has-error' : ''}}">
    {!! Form::label('disponivel', 'Disponível?', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('disponivel',['Não', 'Sim'], null, ['class' => 'form-control']) !!}
        {!! $errors->first('disponivel', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('tipo_produto_id') ? 'has-error' : ''}}">
    {!! Form::label('tipo_produto_id', 'Tipo Produto', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('tipo_produto_id',$tipoProduto, null, ['class' => 'form-control']) !!}
        {!! $errors->first('tipo_produto_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    <label for="description" class="col-md-4 control-label">{{ 'Description' }}</label>
    <div class="col-md-6">
        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
    <label for="price" class="col-md-4 control-label">{{ 'Price' }}</label>
    <div class="col-md-6">
        {!! Form::text('price', null, ['class' => 'form-control', 'type' => 'number', 'id' => 'price']) !!}
        {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
