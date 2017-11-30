<div class="form-group {{ $errors->has('nome') ? 'has-error' : ''}}">
    <label for="nome" class="col-md-4 control-label">{{ 'Nome' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="nome" type="text" id="nome" value="{{ $funcionario->nome or ''}}" >
        {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('data_nascimento') ? 'has-error' : ''}}">
    <label for="data_nascimento" class="col-md-4 control-label">{{ 'Data Nascimento' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="data_nascimento" type="date" id="data_nascimento" value="{{ $funcionario->data_nascimento or ''}}" >
        {!! $errors->first('data_nascimento', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
