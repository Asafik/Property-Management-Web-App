@extends('layouts.partial.app')

@section('title','Persiapan Pecah Legal Unit')

@section('content')

<div class="container-fluid">
    <div class="card">
        <div class="card-body">

            <h4>
                <i class="mdi mdi-file-document-edit-outline text-warning"></i>
                Persiapan Pecah Legal Unit
            </h4>

            <p><b>Customer:</b> {{ $application->customer->full_name }}</p>
            <p><b>Unit:</b> {{ $application->unit->unit_name }}</p>
            <p><b>Bank:</b> {{ $application->bank->bank_name }}</p>

        </div>
    </div>
</div>

@endsection