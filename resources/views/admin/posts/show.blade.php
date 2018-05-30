@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="pnael panel-default">
                <div class="panel-heading">
                    Post Show
                    
                </div>
                <div class="panel-body">                                      
                    <p><strong>NAME:</strong>&nbsp;{{ $post->name }}</p>
                    <p><strong>SLUG:</strong>&nbsp;{{ $post->slug }}</p>
                    <p><strong>EXCERPT:</strong>&nbsp;{{ $post->excerpt }}</p> 
                    <p><strong>DESCRIPTION:</strong>&nbsp;{{ $post->body }}</p> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection