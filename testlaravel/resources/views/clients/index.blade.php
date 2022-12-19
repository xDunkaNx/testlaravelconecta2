@extends('layouts.app')

@section('content')
  <div class="container-app">
    @isset($errorToken)
        <div>
            {{$errorToken}}
        </div>
    @endisset

    @if(!isset($errorToken))
      <div class="container-fluid">
        @include('clients._tablecliente')
      </div>
    @endif
  </div>
@endsection
