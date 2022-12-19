@extends('layouts.app')

@section('content')
  <div class="container-app">
    <a href="/"><button>Regresar</button></a>
    @include('transaction._tabletransaction')
  </div>
@endsection