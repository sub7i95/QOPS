<h1 class="mt-5">Surveys</h1>
@if (\Session::has('message'))
<div class="alert alert-success py-2 text-center my-2" role="alert">
    <span class="font-weight-bold">{!! \Session::get('message') !!}</span>
</div>
@endif
@if( $errors->any() )
<div class="alert   alert-danger rounded py-2  my-2 ">
    <ul class="list-unstyled m-0 p-2">
        @foreach ($errors->all() as $error)
        <li class="font-weight-bold unlisted">{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif