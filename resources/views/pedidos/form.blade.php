
<div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    {!! Form::label('user_id', 'Cliente', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('user_id',$users, null, ['class' => 'form-control']) !!}
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('endereco') ? 'has-error' : ''}}">
    {!! Form::label('endereco', 'Endereco', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('endereco', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('endereco', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('numero') ? 'has-error' : ''}}">
    {!! Form::label('numero', 'Numero', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('numero', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('numero', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('bairro') ? 'has-error' : ''}}">
    {!! Form::label('bairro', 'Bairro', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('bairro', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('bairro', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('complemento') ? 'has-error' : ''}}">
    {!! Form::label('complemento', 'Complemento', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('complemento', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('complemento', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('forma_pagamento') ? 'has-error' : ''}}">
    {!! Form::label('forma_pagamento', 'Forma Pagamento', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('forma_pagamento',['dinheiro' => 'Dinheiro', 'cartao_credito' => 'Cartão Crédito', 'cartao_debito' => 'Cartão Débito'], null, ['class' => 'form-control']) !!}
        {!! $errors->first('forma_pagamento', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('troco') ? 'has-error' : ''}}">
    {!! Form::label('troco', 'Troco', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('troco', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('troco', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
