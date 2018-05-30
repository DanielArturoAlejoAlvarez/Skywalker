@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="pnael panel-default">
                <div class="panel-heading">
                    Posts List
                    <a href="{{ route('posts.create') }}" class="btn btn-primary btn-sm pull-right">Create</a>
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
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td>{{ $post->name }}</td>
                                    <td width="10">                                    
                                        <a class="btn btn-default btn-sm" href="{{ route('posts.show',$post->id) }}">View</a>
                                    </td>
                                    <td width="10">
                                        <a class="btn btn-warning btn-sm" href="{{ route('posts.edit',$post->id) }}">Edit</a>
                                    </td>
                                    <td width="10">
                                        {!!Form::open(['route'=>['posts.destroy',$post->id], 'method'=>'DELETE'])!!}
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                        {!!Form::close()!!}
                                    </td>
                                </tr>
                            @endforeach                            
                        </tbody>
                    </table>
                    {{ $posts->render() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection