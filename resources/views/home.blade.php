@extends('layouts.app')

@section('content')
<div class="row my-5">
    <div class="col-md-12">
        <home-component :user_id="{{auth()->user()->id}}"></home-component>
    </div>
</div>
@endsection

