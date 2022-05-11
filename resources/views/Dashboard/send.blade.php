@extends('layout.app')

@section('content')

<div class="alert alert-success alert-dismissible fade show d-none send-poll mt-4 " role="alert">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
    </svg>
    ¡Encuesta enviada correctamente!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<div class="alert alert-danger alert-dismissible fade show d-none fail-send" role="alert">
    ¡No se pudo enviar la encuesta!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="row mb-2">
    <div class="col-lg-12">
        <h4 class="text-left">Configuración de envios</h4>
    </div>
</div>

<div class="d-flex align-items-center justify-content-around text-center parrafo mb-4" style="font-size: 10pt">
    <div class="d-flex flex-column align-items-center plan-step plan-step-p1 active" data-next="1" style="width: 70px">
        <span class="icon-box eye-icon shadow border-0 mb-2 active" style="border-radius: 12px">
        </span>
        <span data-mobil="Muestra" data-desk="Seleccionar correos" class="nav-pulso"></span>
    </div>
    <div class="d-flex flex-column align-items-center plan-step plan-step-p2" data-next="2" style="width: 135px">
        <div class="icon-box edit-icon shadow border-0 mb-2" style="border-radius: 12px">
        </div>
        <span data-mobil="Encuesta" class="nav-pulso" data-desk="Selecciona encuesta"></span>
    </div>
    <div class="d-flex flex-column align-items-center plan-step plan-step-p4" data-next="4" style="width: 70px">
        <span class="icon-box result-icon shadow border-0 mb-2" style="border-radius: 12px">
        </span>
        <span data-mobil="Previsualizar" class="nav-pulso" data-desk="Previsualización"></span>
    </div>
</div>

<div class="progress" style="height: 6px;">
    <div class="progress-bar" role="progressbar" style="width: 25%; background-image: radial-gradient(circle at -20.26% 56.15%, #fffc5a 0, #fffb50 12.5%, #e8f848 25%, #d0f641 37.5%, #b5f23c 50%, #98ee3a 62.5%, #77ea3d 75%, #4de743 87.5%, #00e34c 100%);" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
</div>


<div class="first-step mt-3">

    <div class="row mt-4">
        <div class="col-lg-12 text-end">
            <button class="btn btn-outline-primary rounded-pill btn-question-custom text-white btn-firts" disabled>Siguiente</button>
        </div>
    </div>

    <div class="card border-0 shadow mt-3 " style="border-radius: 25px;">
        <div class="card-header card-send border-0" style="color: #fff; border-radius: 25px 25px 0 0">
            Adjuntar correos
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="categorie">Selecciona un archivo excel con la lista correos</label>
                <input type="file" name="emails" class="form-control mt-2 custom-input ignore" placeholder="Cargar icono">

            </div>
        </div>
    </div>
</div>

<div class="second-step mt-3 d-none">

    <div class="row mt-4">
        <div class="col-lg-6 ">
            <button class="btn back-second">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
                </svg> <strong>Regresar</strong> </button>
        </div>
        <div class="col-lg-6 text-end">
            <button class="btn btn-outline-primary rounded-pill btn-question-custom text-white btn-second" disabled>Siguiente</button>
        </div>
    </div>

    <div class="card border-0 shadow mt-3" style="border-radius: 25px;">
        <div class="card-header card-send border-0" style="color: #fff; border-radius: 25px 25px 0 0">
            Selecciona la encuesta
        </div>
        <div class="card-body">
            <table class="responsive table">
                <thead class="text-muted">
                    <th>Nombre de la encuesta</th>
                    <th>Preguntas</th>
                    <th>Fecha creación</th>
                    <th>Seleccionar</i></th>
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
        </div>
    </div>
</div>

<div class="final-step mt-3 d-none">

    <div class="row mt-4">
        <div class="col-lg-6">
            <button class="btn back-final">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
                </svg> <strong>Regresar</strong> </button>
        </div>
        <div class="col-lg-6 text-end">
            <button class="btn btn-outline-primary rounded-pill btn-question-custom text-white btn-final-poll">Enviar encuesta</button>
        </div>
    </div>

    <div class="card border-0 shadow mt-3" style="border-radius: 25px;">
        <div class="card-header card-send border-0" style="color: #fff; border-radius: 25px 25px 0 0">
            Previsualización
        </div>
        <div class="card-body pt-5">

            <div class="row">
                <div class="col-lg-6"><strong>Encuesta seleccionada</strong> </div>
            </div>
            <div class="row border p-2" style="border-radius: 15px;">
                <div class="col-lg-6 poll-name">---</div>
            </div>

            <div class="row">
                <div class="col-lg-6"><strong>Archivo seleccionado</strong> </div>
            </div>
            <div class="row border p-2 mb-3" style="border-radius: 15px;">
                <div class="col-lg-6 file-mails">---</div>
            </div>

        </div>
    </div>
</div>

@endsection