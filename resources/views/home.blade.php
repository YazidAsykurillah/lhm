@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')

    @if(\Auth::user()->can('access-admin-dashboard'))
        @include('admin-dashboard')
    @else
        @include('non-admin-dashboard')
    @endif
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <style>
    /* Tingkatkan z-index jQuery Toast */
    .jquery-toast-wrap {
      z-index: 1100 !important;
    }
  </style>
@stop

@section('js')
    
@stop