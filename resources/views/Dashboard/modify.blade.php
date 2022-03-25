@extends('layout.app')

@section('content')

<div class="alert alert-success alert-dismissible fade show  mt-4 d-none" role="alert">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
    </svg>
    ¡Encuesta modificada correctamente!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>


<div class="alert alert-danger alert-dismissible fade show  mt-4 d-none" role="alert">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-diamond-fill" viewBox="0 0 16 16">
        <path d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098L9.05.435zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
    </svg>
    ¡No se puede modificar una encuesta que ya ha sido enviada a los cliente!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>



<form class="form-questions-modify mt-4" id="form-questions-modify" method="post">

    <div class="row">
        <div class="col-lg-12 pr-0">
            <div class="card border-0 mb-4" style="border-radius: 20px;box-shadow: 0px 0px 7px 0px #ddd;">
                <div class="card-body">
                    <div class="form-group mb-2">
                        <input type="text" class="form-control custom-input-title" require id="title-modify" name="title" required placeholder="Título de la encuesta">
                    </div>
                </div>
            </div>
        </div>

    </div>



    <div class="d-flex justify-content-center">
        <div class="spinner-border text-primary " role="status">
        </div>
    </div>

    <div class="row mb-3 mt-4">
        <div class="col-lg-9">
            <p class="h5 mb-3">
                Preguntas
            </p>
        </div>
        <div class="col-lg-2 text-end">
            <button type="submit" class="btn btn-primary btn-question-custom btn-save-questions rounded-pill px-4">
                <div class="spinner-border loader-save-questions spinner-border-sm d-none" role="status">
                </div>
                <strong>Guardar</strong>
            </button>
        </div>
    </div>

</form>

<script id="template-questions" type="text/x-handlebars-template">
    <div class="row mb-4 me-0">
        <div class="col-lg-11">
            <div class="card border-0 custom-card border-radiant" style="border-radius: 16px;box-shadow: 0px 0px 7px 0px #ddd;">
                <div class="card-body pt-4">
                    <div class="row">
                        <div class="form-group mb-0 col-lg-8">
                            <input type="text" class="form-control custom-input" data-question="@{{element.idQuestions}}" require id="spanish_statement" value="@{{element.question}}" name="question[]" placeholder="Ingresa la pregunta">
                            <label for="spanish_statement"></label>
                        </div>
                        <div class="form-group mb-0 col-lg-4">
                            <Select class="form-select type-question" require name="response_type[]">
                                <option value="" disabled selected>Tipo de pregunta</option>
                                <option value="1">Si y no</option>
                                <option value="2">Calificación</option>
                                <option value="3">De acuerdo y desacuerdo</option>
                                <option value="4">Respuesta abierta</option>
                            </Select>
                        </div>

                        <div class="col-lg-8 type-0 text-center">
                            <p class="text-muted"><strong>Selecciona el tipo de pregunta</strong> </p>
                        </div>
                        
                        <!-- Question type 1 -->
                        <div class="col-lg-8 d-none type-1">
                            <div class="d-flex flex-column  mt-4 mb-3">
                                <div class="p-2 custom-selected" id="ta-">
                                    <label for="ta" class="form-check-label">
                                        <input class="form-check-input required custom-checked ignore" id="ta" value="yes" type="radio" name="qualification" style="visibility: hidden;"><strong>Si</strong>
                                    </label>
                                </div>
                                <div class="p-2 custom-selected" id="ta-">
                                    <label for="ta" class="form-check-label">
                                        <input class="form-check-input required custom-checked ignore" id="td" value="no" type="radio" name="qualification" style="visibility: hidden;"><strong>No</strong> 
                                    </label>
                                </div>
                            </div>
                        </div>

                       
                        <!-- Question type 2 -->
                        <div class="col-lg-8 d-none type-2">
                            <div class="d-flex justify-content-center mt-2 mb-5  pr-col-1">
                                <div class="row shadow rounded">
                                    <div class=" col-lg-6 p-2 px-4 border-end text-center">
                                        <p class="mb-2">Tu respuesta</p>
                                        <img class="range-img" src="/images/icon-range-5.svg" alt="icono">
                                    </div>
                                    <div class="px-5 py-4 col-lg-6">
                                        <h2 class="range-value pt-2">5</h2>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-8 col-md-8 m-auto p-0 mb-3">
                                <input type="range" require="false" id="range" min="1" max="10" name="qualification" class="form-range custom-range range-focus shadows-sm ignore" value="5" />
                            </div>

                        </div>

                        <!-- Question type 3 -->
                        <div class="col-lg-8 d-none type-3">
                            <div class="d-flex flex-column my-3 ml-2">
                                <div class="p-2  custom-selected" id="ta-">
                                    <label for="ta" class="form-check-label">
                                        <input class="form-check-input required custom-checked ignore" id="ta" value="td" type="radio" name="qualification" style="visibility: hidden;"> <strong>Totalmente de acuerdo</strong> 
                                    </label>
                                </div>
                                <div class="p-2  custom-selected" id="dc-">
                                    <label for="dc" class="form-check-label">
                                        <input class="form-check-input required custom-checked ignore" id="dc" value="deac" type="radio" name="qualification" style="visibility: hidden;"><strong>De acuerdo</strong> 
                                    </label>
                                </div>

                                <div class="p-2  custom-selected" id="nda-">
                                    <label for="nda" class="form-check-label">
                                        <input class="form-check-input required custom-checked ignore" id="nda" value="nidd" type="radio" name="qualification" style="visibility: hidden;"><strong>Ni de acuerdo ni en desacuerdo</strong> 
                                    </label>
                                </div>
                                <div class="p-2  custom-selected" id="da-">
                                    <label for="da" class="form-check-label">
                                        <input class="form-check-input required custom-checked ignore" id="da" value="ds" type="radio" name="qualification" style="visibility: hidden;"> <strong>Desacuerdo</strong> 
                                    </label>
                                </div>
                                <div class="p-2  custom-selected" id="td-">
                                    <label for="td" class="form-check-label">
                                        <input class="form-check-input required custom-checked ignore" id="td" value="tds" type="radio" name="qualification" style="visibility: hidden;"><strong>Totalmente de acuerdo</strong> 
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Question type 4 -->
                        <div class="col-lg-8 d-none type-4">
                            <div class="d-flex flex-column my-3 ml-3">
                                <textarea class="form-control question-text ignore" placeholder="Respuesta..." rows="5" disabled cols="40"></textarea>
                            </div>
                        </div>

                        <div class="col-lg-12 text-end border-top mt-3 pt-2">
                            <button type="button" class="btn border-right remove-question d-none"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-1 pt-4 bg-white text-center" style="
                    border-radius: 15px;
                    box-shadow: 0 0 6px 1px #ddd;
                    height: 89px;">
            <button type="button" class="btn text-center p-1 add-question" data-toggle="tooltip" data-placement="right" title="Añadir pregunta">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                </svg>
            </button>
        </div>
    </div>
</script>

@endsection