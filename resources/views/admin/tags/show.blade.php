@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="pnael panel-default">
                <div class="panel-heading">
                    Tags Show
                    
                </div>
                <div class="panel-body">                                      
                    <p><strong>NAME:</strong>&nbsp;{{ $tag->name }}</p>
                    <p><strong>SLUG:</strong>&nbsp;{{ $tag->slug }}</p> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection