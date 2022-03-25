@extends('layout.poll')

@section('content')

<div class="row mt-5">
    <div class="col-lg-12 title-header text-center">
        <h4><strong>Bienvenido</strong></h4>
    </div>
</div>

<div class="row mt-5 pt-5 m-auto" id="npsQuestionContent">

</div>


@include('Poll.template-question')
@include('Poll.introModal')
@include('Poll.feelings')

@endsection