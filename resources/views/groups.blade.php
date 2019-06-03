

@extends('layouts.app')

@section('content')

    <div class="container">
        <hr>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-sm-11">Группы</div>
                            <div class="col-sm-1">
                                <button type="button" class="btn btn-success btn-sm" onclick="window.location.href='/groups_create'">Создать</button>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            @foreach($groups_list as $group)                                
                                <div class="col-lg-12">
                                    <a href="/group/{{$group->id}}">{{$group->name_group}}</a>
                                </div>
                                <hr>                                
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection