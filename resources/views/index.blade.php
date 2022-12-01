@extends('app')
 
@section('contents')
    {!! $dataTable->table() !!}
@endsection
 
@push('scripts')
    {!! $dataTable->scripts() !!}
@endpush