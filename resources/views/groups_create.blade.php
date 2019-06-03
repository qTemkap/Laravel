@extends('layouts.app')

@section('content')
<div class="container">
    <hr>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Создание группы</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('groups_add') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="text" class="col-md-4 control-label">Название группы</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="" required autofocus>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="text" class="col-md-4 control-label">Дата события</label>

                            <div class="col-md-6">
                                <input id="date" name="date" type="date">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="text" class="col-md-4 control-label">Описание</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description" required>
                            </div>
                        </div>                  

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Создать
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection