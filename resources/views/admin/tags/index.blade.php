@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="pnael panel-default">
                <div class="panel-heading">
                    Tags List
                    <a href="{{ route('tags.create') }}" class="btn btn-primary btn-sm pull-right">Create</a>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr>
                                <th width="10">ID</th>
                                <th>NAME</th>
                                <th colspan="3">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tags as $tag)
                                <tr>
                                    <td>{{ $tag->id }}</td>
                                    <td>{{ $tag->name }}</td>
                                    <td width="10">                                    
                                        <a class="btn btn-default btn-sm" href="{{ route('tags.show',$tag->id) }}">View</a>
                                    </td>
                                    <td width="10">
                                        <a class="btn btn-warning btn-sm" href="{{ route('tags.edit',$tag->id) }}">Edit</a>
                                    </td>
                                    <td width="10">
                                        {!!Form::open(['route'=>['tags.destroy',$tag->id], 'method'=>'DELETE'])!!}
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                        {!!Form::close()!!}
                                    </td>
                                </tr>
                            @endforeach                            
                        </tbody>
                    </table>
                    {{ $tags->render() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection