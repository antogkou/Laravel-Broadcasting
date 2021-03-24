@extends('layouts.app')
@section('content')
<div class="py-12">
    <div id="app" class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <project-component :data-project="{{$project}}"></project-component>
    </div>
</div>
</div>
@endsection
