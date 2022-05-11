@extends('layout.app')

@section('content')


<div class="row mb-2">
    <div class="col-lg-12">
        <h5 class="text-left">Análisis generales</h5>
    </div>
</div>

<div class="row">
    <div class="col-lg-3 ">
        <div class="card shadow border-0 custom-cards nps-general">
            <div class="card-body">
                <strong>NPS General</strong>
                <h1 class="text-center mb-0 npsgeneral">-</h1>
            </div>
        </div>

    </div>

    <div class="col-lg-3 ">
        <div class="card shadow border-0 custom-cards promoters">
            <div class="card-body text-center">
                <p class="mb-0 pt-3 h5 neutrals"><img src="/images/smile.svg" alt=""> <strong class="promoteres">-</strong></p>
                <strong>Promotores</strong>
            </div>
        </div>
    </div>

    <div class="col-lg-3 ">
        <div class="card shadow border-0 custom-cards neutrales">
            <div class="card-body text-center">
                <p class="mb-0 pt-3 h5 neutrals"><img src="/images/neutral.svg" alt=""> <strong class="neutral">-</strong></p>
                <strong>Neutrales</strong>
            </div>
        </div>
    </div>

    <div class="col-lg-3 ">
        <div class="card shadow border-0 custom-cards detractors">
            <div class="card-body text-center">
                <p class="mb-0 pt-3 h5 neutrals"><img src="/images/detractores.svg" alt=""> <strong class="detractor">-</strong></p>
                <strong>Dectratores</strong>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4 mt-5">
    <div class="col-lg-12">
        <h3 class="text-center">Reportes</h3>
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <label for=""> <strong>Encuesta</strong></label>
        <select class="form-select polls-reports" aria-label="Default select example">
        </select>
    </div>
    <div class="col-lg-4">
        <label for=""> <strong>Desde</strong></label>
        <input type="date" class="form-select" name="init">
        <span class="text-danger d-none date-init">Campo requerido</span>
    </div>
    <div class="col-lg-4">
        <label for=""> <strong>Hasta</strong></label>
        <input type="date" class="form-select" name="end">
        <span class="text-danger d-none date-end">Campo requerido</span>
    </div>

</div>

<div class="row mb-2 mt-5">
    <div class="col-lg-12">
        <div class="card shadow border-0 custom-cards">
            <div class="card-body text-center">
                <strong>Opiniones</strong>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-lg-6 mb-3">
        <div class="card shadow border-0 custom-cards">
            <div class="card-body text-center">
                <strong>Satisfecho</strong>
                <canvas id="satisfecho" class="mt-4" width="100" height="45"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="card shadow border-0 custom-cards">
            <div class="card-body text-center">
                <strong>Insatisfecho</strong>
                <canvas id="insatisfecho" class="mt-4" width="100" height="45"></canvas>
            </div>

        </div>
    </div>

    <div class="col-lg-6">
        <div class="card shadow border-0 custom-cards">
            <div class="card-body text-center">
                <strong>Enojado</strong>
                <canvas id="enojado" class="mt-4" width="100" height="45"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card shadow border-0 custom-cards">
            <div class="card-body text-center">
                <strong>Medición general</strong>
                <div class="mg">
                    <!-- <canvas id="graphPie" class="mt-4" width="100" height="45"></canvas> -->
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row mb-2 mt-4">
    <div class="col-lg-12">
        <div class="card shadow border-0 custom-cards">
            <div class="card-body text-center">
                <strong>Mediciones por preguntas</strong>
            </div>
        </div>
    </div>
</div>

<div class="row mb-2 mt-4">
    <div class="col-lg-12">
        <div class="card shadow border-0 custom-cards">
            <div class="card-body text-center">
                <strong>Medición NPS</strong>
                <canvas id="nps" class="mt-4" width="100" height="30"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row mb-2 mt-5">
    <div class="col-lg-12">
        <div class="card shadow border-0 custom-cards">
            <div class="card-body text-center">
                <strong>Medición por pregunta</strong>
                <div class="mp">
                    <!-- <canvas id="nide" class="mt-4" width="100" height="35"></canvas> -->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-2 mt-5">
    <div class="col-lg-12">
        <div class="card shadow border-0 custom-cards">
            <div class="card-body text-center">
                <strong>Preguntas de decisión</strong>
                <div class="md">
                    <!-- <canvas id="sino" class="mt-4" width="100" height="45"></canvas> -->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-2 mt-5">
    <div class="col-lg-12">
        <div class="card shadow border-0 custom-cards">
            <div class="card-body text-center">
                <strong>Preguntas abiertas</strong>
                <div class="nube-content">
                    <!-- <div id="nube"></div> -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection