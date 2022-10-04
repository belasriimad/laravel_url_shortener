@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-md-10 mx-auto">
        <app-component :user_id="{{auth()->user()->id}}" /> 
    </div>
</div>
@endsection