@extends('layouts.partial.app')

@section('title','Serah Terima Unit')

@section('content')

<div class="container-fluid">
    <div class="card">
        <div class="card-body">

            <h4 class="mb-3">
                <i class="mdi mdi-home-check text-primary"></i>
                Serah Terima Unit
            </h4>

            <p><b>Customer :</b> {{ $application->customer->full_name }}</p>
            <p><b>Unit :</b> {{ $application->unit->unit_name }}</p>
            <p><b>Bank :</b> {{ $application->bank->bank_name }}</p>

        </div>
    </div>
</div>

@endsection