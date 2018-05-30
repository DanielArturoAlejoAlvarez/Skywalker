@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="pnael panel-default">
                <div class="panel-heading">
                    Category Edit
                    
                </div>
                <div class="panel-body">                                      
                     {!!Form::model($category,['route'=>['categories.update', $category->id], 'method'=>'PUT'])!!}

                        @include('admin.categories.partials.form')
                        
                     {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection