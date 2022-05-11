<style>
    [type=radio] {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* IMAGE STYLES */
    [type=radio]+img {
        cursor: pointer;
    }

    /* CHECKED STYLES */
    [type=radio]:checked+img {
        border: 2px solid #e55d0c;
        border-radius: 30px;
        padding: 10px;
    }
</style>
<div class="modal fade" id="segmentation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0" style="border-radius: 25px">
            <div class="modal-body py-0">
                <div id="feelings-today" class="px-5 pb-5 pt-3">
                    <h1 class="text-primary mb-5 text-center title-question">¿Qué tan gratificante ha sido tu experiencia con nosotros?</h1>
                    <div class="row text-center">

                        <div class="col-lg-4 col-md-4 col-4">
                            <label class="form-check-label">
                                <input class="form-check-input required feelings-emoji" type="radio" name="feeling" value="1">
                                <img src="/images/emoji-5.svg" alt="Enojado" data-toggle="tooltip" data-placement="top" title="Satisfecho">
                            </label>

                        </div>

                        <div class="col-lg-4 col-md-4 col-4">
                            <label class="form-check-label">
                                <input class="form-check-input required feelings-emoji" type="radio" name="feeling" value="2">
                                <img src="/images/emoji-4.svg" alt="Enojado" data-toggle="tooltip" data-placement="top" title="Insatisfecho">
                            </label>
                        </div>

                        <div class="col-lg-4 col-md-4 col-4 ml-5">
                            <label class="form-check-label">
                                <input class="form-check-input required feelings-emoji" type="radio" name="feeling" value="3">
                                <img src="/images/emoji-2.svg" alt="Enojado" data-toggle="tooltip" data-placement="top" title="Enojado">
                            </label>
                        </div>

                    </div>
                    <div class="row text-center">
                        <div class="col-lg-4"><small><strong>Satisfecho</strong></small></div>
                        <div class="col-lg-4"><small><strong>Insatisfecho</strong></small></div>
                        <div class="col-lg-4"><small><strong>Enojado</strong></small></div>

                        <div class="col-lg-12 text-center mt-5">
                            <button type="button" class="btn btn-primary pill rounded-pill btn-question-custom px-5 feeling-btn" disabled ><strong>Siguiente</strong> </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>