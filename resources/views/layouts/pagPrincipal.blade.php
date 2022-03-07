@push ('css')
<link href="{{URL::asset('./css/pagPrincipal.css')}}" rel="stylesheet ">
<link href="https://fonts.googleapis.com/css2?family=Nova+Round&family=Permanent+Marker&display=swap" rel="stylesheet">
<script src="https://code.iconify.design/2/2.1.2/iconify.min.js"></script>
@endpush
@extends('layouts.masterpage')
@section('titulo', "Principal")
@section('contenido')

<div id="video">
    <a id="mostrar-home" href="{{route('home')}}">Home</a>
    <iframe src="https://www.youtube.com/embed/m5eOXGamJ5U?autoplay=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    {{-- video presentacion gure tabadul --}}
</div>
{{-- end video --}}
@endsection
