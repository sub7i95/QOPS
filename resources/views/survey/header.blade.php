<h1>Surveys</h1>

@if (\Session::has('message'))
<div class="alert alert-success py-2 text-center my-2" role="alert">
    <span class="font-weight-bold">{!! \Session::get('message') !!}</span>
</div>
@endif

@if( $errors->any() )
<div class="border border-danger alert-danger rounded py-2  my-2 bg-danger">
    <ul class="list-unstyled mx-4">
        @foreach ($errors->all() as $error)
        <li class="font-weight-bold unlisted text-white">{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif