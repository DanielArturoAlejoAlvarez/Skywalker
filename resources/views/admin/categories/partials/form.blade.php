<div class="form-group">
    {{Form::label('name','Name:')}}
    {{Form::text('name',null,['class'=>'form-control', 'id'=>'name'])}}
</div>
<div class="form-group">
    {{Form::label('slug','URL Friendly:')}}
    {{Form::text('slug',null,['class'=>'form-control', 'id'=>'slug'])}}
</div>
<div class="form-group">
    {{Form::label('body','Description:')}}
    {{Form::textarea('body',null,['class'=>'form-control'])}}
</div>
<div class="form-group">
    {{Form::submit('SUBMIT',['class'=>'btn btn-primary btn-sm'])}}
</div>


@section('scripts')
    <script src="{{ asset('vendor/stringToSlug/jquery.stringToSlug.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('#name, #slug').stringToSlug({
                callback: function(text){
                    $('#slug').val(text);
                }
            });
        });
    </script>
@endsection
                    
                