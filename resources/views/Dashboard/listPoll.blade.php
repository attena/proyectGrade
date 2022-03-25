@extends('layout.app')

@section('content')

<div class="alert alert-danger alert-dismissible fade show d-none" role="alert">
    ¡Parece que algo salio mal, intenta nuevamente!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="row mb-2">
    <div class="col-lg-12">
        <h4 class="text-left">Encuestas creadas</h4>
    </div>
</div>

<table class="responsive table">
    <thead class="text-muted">
        <th>Nombre de la encuesta</th>
        <th>Preguntas</th>
        <th>Fecha creación</th>
        <th>Acciones</i></th>
    </thead>
    <tbody class="add-list-polls">
        <tr class="border-0 hiden-tr">
            <td colspan="4" align="center" class="border-0">
                <div class="spinner-border text-primary" role="status">
                </div>
            </td>
        </tr>

    </tbody>
</table>
<div class="text-end mt-3 hidden-btns d-none">
    <button type="btn" class="btn btn-outline-primary rounded-pill btn-action-custom text-muted btn-delete-poll">
        <span class="spinner-border spinner-border-sm d-none loader-deteled" role="status" aria-hidden="true"></span>
        Eliminar encuesta
    </button>
    <button type="btn" class="btn btn-outline-primary rounded-pill btn-question-custom text-white btn-redirect">
        <span class="spinner-border spinner-border-sm d-none loader-deteled" role="status" aria-hidden="true"></span>
        Modificar encuesta
    </button>
</div>

@include('Dashboard.alert')
@endsection