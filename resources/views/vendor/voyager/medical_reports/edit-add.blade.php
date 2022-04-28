@extends('voyager::bread.edit-add')
{{-- 
@php
    $code = "H".str_pad(App\Models\MedicalReport::max("id") + 1, 4, "0", STR_PAD_LEFT);
@endphp --}}
@push('javascript')
    <script>
        
        $("#code_field").prop('hidden',true);
    </script>
@endpush