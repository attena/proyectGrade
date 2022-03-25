<!-- TEMPLATES -->

<!-- Question type 1 -->
<script id="npsQuestionT1Template" type="text/x-handlebars-template">
    <div class="col-lg-10 shadow px-4 m-auto custom-card-question" style="border-radius: 25px;">
        <h3 class="mt-5 pt-5 text-center">
            <strong>
                @{{ pollquestions.statement }}
                Pregunta 1 .....
            </strong>
        </h3>
        <div class="col-lg-6 m-auto  mt-4 mb-3">
            <div class="p-2  custom-selected" id="ta-">
                <label for="ta" class="form-check-label">
                    <input class="form-check-input required custom-checked" id="ta" value="1" type="radio" name="qualification" style="visibility: hidden;">Si
                </label>
            </div>
            <div class="p-2  custom-selected" id="ta-">
                <label for="ta" class="form-check-label">
                    <input class="form-check-input required custom-checked" id="td" value="0" type="radio" name="qualification" style="visibility: hidden;">No
                </label>
            </div>
        </div>
        <div class="col-lg-12 text-center">
            <button class="btn btn-primary rounded-pill text-left my-4 px-5 justify-content-center next-question btn-question-custom " disabled>
                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>             
                <strong>Siguiente</strong>
            </button>
        </div>
    </div>
</script>


<!-- Question type 2 -->
<script id="npsQuestionT2Template" type="text/x-handlebars-template">

    <div class="col-lg-10 shadow px-4 m-auto custom-card-question" style="border-radius: 25px;">
        <div class="row">
            <div class="col-lg-12 mt-2">
                <p>
                    Califica tu respuesta de 1 a 10
                </p>
            </div>
            <div class="col-lg-12 mb-3 text-center">
                <h3>
                    <strong>
                            @{{ pollquestions.statement_en }}
                            Pregunta 2 .....
                    </strong>
                </h3>
            </div>
            <div class="col-lg-12">

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

            <div class="col-lg-5 col-md-5 m-auto p-0 mb-3">
                <input type="range" require="false" id="range" min="1" max="10" name="qualification" class="form-range custom-range range-focus shadows-sm ignore" value="5" />
            </div>

        </div>

        <div class="col-lg-12 text-center">
            <button class="btn btn-primary rounded-pill text-left my-4 px-5 justify-content-center next-question btn-question-custom " disabled>
                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                <strong>Siguiente</strong>
            </button>
        </div>
    </div>
</script>


<!-- Question type 3 -->
<script id="npsQuestionT3Template" type="text/x-handlebars-template">

    <div class="col-lg-10 shadow px-4 m-auto custom-card-question" style="border-radius: 25px;">
        <div class="type4">
            <div class="row">
                <div class="col-lg-12 mt-5 text-center">
                    <h4>
                        <strong>
                            @{{ pollquestions.statement }}
                            Pregunta 3 ....
                        </strong>
                    </h4>
                </div>
                <div class="col-lg-6 m-auto my-3 ml-2">
                    <div class="p-2  custom-selected" id="ta-">
                        <label for="ta" class="form-check-label">
                            <input class="form-check-input required custom-checked" id="ta" value="5" type="radio" name="qualification" style="visibility: hidden;">Totalmente de acuerdo
                        </label>
                    </div>
                    <div class="p-2  custom-selected" id="dc-">
                        <label for="dc" class="form-check-label">
                            <input class="form-check-input required custom-checked" id="dc" value="4" type="radio" name="qualification" style="visibility: hidden;">De acuerdo
                        </label>
                    </div>

                    <div class="p-2  custom-selected" id="nda-">
                        <label for="nda" class="form-check-label">
                            <input class="form-check-input required custom-checked" id="nda" value="3" type="radio" name="qualification" style="visibility: hidden;">Ni de acuerdo ni en desacuerdo
                        </label>
                    </div>
                    <div class="p-2  custom-selected" id="da-">
                        <label for="da" class="form-check-label">
                            <input class="form-check-input required custom-checked" id="da" value="2" type="radio" name="qualification" style="visibility: hidden;">Desacuerdo
                        </label>
                    </div>
                    <div class="p-2  custom-selected" id="td-">
                        <label for="td" class="form-check-label">
                            <input class="form-check-input required custom-checked" id="td" value="1" type="radio" name="qualification" style="visibility: hidden;">Totalmente desacuerdo
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 text-center">
            <button class="btn btn-primary rounded-pill text-left my-4 px-5 justify-content-center next-question btn-question-custom " disabled>
                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                <strong>Siguiente</strong> 
            </button>
        </div>
    </div>

    
</script>


<!-- Question type 4 -->
<script id="npsQuestionT4Template" type="text/x-handlebars-template">
    
    <div class="col-lg-10 shadow px-4 m-auto custom-card-question" style="border-radius: 25px;">
        <div class="type4">
            <div class="row">
                <div class="col-lg-12 mt-5 text-center">
                    <h4>
                        <strong>
                            @{{ pollquestions.statement }}
                            Pregunta 4 ....
                        </strong>
                    </h4>
                </div>
                <div class="col-lg-6 m-auto my-3 ml-3">
                    <textarea class="form-control question-text" placeholder="Respuesta..." rows="5" cols="40"></textarea>
                </div>
            </div>
        </div>

        <div class="col-lg-12 text-center">
            <button class="btn btn-primary rounded-pill text-left my-4 px-5 justify-content-center next-question btn-question-custom " disabled>
                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                <strong>Siguiente</strong> 
            </button>
        </div>
    </div>

</script>