let acountPage = 1;
let questionVal;
let currentPage;
let total = 1;
let typeQuestion;
let contextTemplate;
let valueFeelings;
let finish = false;
let questionId;
let catId;
let sumary;
let sumaryCustom;
let deepening;
let poll_active_resumen;

$(function () {



    $("#introModalQuestion").modal("show");

    $("#pollInitQuestion").on("click", function () {
        $("#introModalQuestion").modal("hide");
        $("#segmentation").modal("show");
    });

    $(".feeling-btn").on("click", function(){

        console.log('entrando')
        $("#segmentation").modal("hide")

        // $("#npsQuestionContent").append(
        //     templateHB("npsQuestionT1Template", contextTemplate)
        // );
    
        // $("#npsQuestionContent").append(
        //     templateHB("npsQuestionT2Template", contextTemplate)
        // );
    
        // $("#npsQuestionContent").append(
        //     templateHB("npsQuestionT3Template", contextTemplate)
        // );
    
        $("#npsQuestionContent").append(
            templateHB("npsQuestionT4Template", contextTemplate)
        );
    
    });





    $("input[name='feeling']").on("change", function () {
        $("#btn-feelings").prop("disabled", false);
        valueFeelings = $(this).val();
    });

    $("#btn-feelings").on("click", function () {
        // $("#segmentation").modal("hide");
        saveFeeling();
    });

    $("body").on("click", ".next-question", function () {
        acountPage = currentPage;
        acountPage++;

        $("body .next-question").prop("disabled", true).html('<span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span> ' + save);
        $("body .spinner-border").removeClass("d-none");
        setTimeout(function () {
            getQuestion();
        }, 300);
    });

    $("body").on("click", ".next-categorie", function () {
        $("#npsQuestionContent").empty();

        if (finish) {
            //finishPoll();
            $('.listCategories').addClass('d-none');
            $(".jumboton-custom").addClass("d-none");
            $('.title-header').addClass('d-none');
            $('.text-finish').removeClass('d-none');
        } else {
            validateTypeQuestion(typeQuestion, contextTemplate);
            ValidateColorCategories(catId);
        }


    });

    $(document).on("input change", ".custom-range", function () {
        $(".range-img").attr(
            "src",
            "/images/icon-range-" + $(this).val() + ".svg"
        );
        $(".range-value").html(validator.escape($(this).val()));
        questionVal = $(this).val();

        if ($(this).val() <= 6 && deepening) {
            $('body .complement-response').removeClass('d-none');
            if ($('body #complement').val().length > 0) {
                $("body .next-question").prop("disabled", false);
            } else {
                $("body .next-question").prop("disabled", true);
            }
        } else {
            $('body .complement-response').addClass('d-none');
            $("body .next-question").prop("disabled", false);
        }
    });

    $("body").on("change keyup paste", "#complement", function () {
        if ($(this).val().trim().length > 0) {
            $("body .next-question").prop("disabled", false);
        } else {
            $("body .next-question").prop("disabled", true);
        }
    });


    $("body").on("change keyup paste", ".question-text", function () {
        if ($(this).val().trim().length > 0) {
            $("body .next-question").prop("disabled", false);
            questionVal = $(this).val();
        } else {
            $("body .next-question").prop("disabled", true);
        }
    });

    $("body").on("click", ".custom-selected", function () {
        let input = $(this).find("input").attr("id")
        let id = $(this).attr("id")

        $("body .custom-selected").attr("style", "background-color: #ffff ");
        $("body .custom-selected")
            .find("label")
            .attr("style", "color: #EA6C00 ");

        $("#" + input).prop("checked", true);
        questionVal = $("#" + input).val();

        if (
            id == "ta-" ||
            id == "td-" ||
            id == "nda-" ||
            id == "dc-" ||
            "da-"
        ) {
            $(this)
                .find("label")
                .attr("style", "color: #ffff ");
            $(this).attr("style", "background-color: #EA6C00 ");
        }
        $("body .next-question").prop("disabled", false);
    });


    $("body").on("click", ".btn-inicitiveYes", function () {
        $(this)
            .removeClass("btn-outline-primary")
            .addClass("btn-primary");
        $("body .btn-inicitiveNo")
            .addClass("btn-outline-primary")
            .removeClass("btn-primary");
        $("#iniciatives").modal("hide");
        $("#interestedModal").modal("show");
    });

    $("body").on("click", ".btn-inicitiveNo", function () {
        $(this)
            .removeClass("btn-outline-primary")
            .addClass("btn-primary");
        $("body .btn-inicitiveYes")
            .addClass("btn-outline-primary")
            .removeClass("btn-primary");
        $("#iniciatives").modal("hide");
        //$("#finishModal").modal("show");
        finish = false;
    });

    $("#form-interested").validate({
        rules: {
            name: {
                required: true
            },
            email: {
                required: true
            }
        },
        messages: {
            name: {
                required: "Campo requerido"
            },
            email: {
                required: "Campo requerido"
            }
        },
        submitHandler: function (form) {
            $(".btn-loading").removeClass("d-none");
            $(".btn-sub").addClass("d-none");
            saveInteresed();
        }
    });

    $('#open-iniciatives').on('click', function () {
        finishPoll();
    });
});

//needs_deepening

function getQuestion() {
    // complement_obj = $('body #complement').length;
    // if (complement_obj <= 0) {
    //     complement_val = '';
    // } else {
    //     complement_val = validator.escape($('body #complement').val());
    // }

    // let exampleSaveQuestion = {};
    // if (acountPage > 1) {
    //     exampleSaveQuestion = {
    //         npsAnswersHeader: npsAnswersHeader,
    //         questionId: questionId,
    //         replay: questionVal,
    //         deepening: complement_val
    //     };
    // }

    if (!finish) {
        let getData = getDataAjax(
            "/happindex/pollReplay/getQuestion/" +
            poll.id +
            "?page=" +
            acountPage,
            "post",
            exampleSaveQuestion
        );
        getData.done(function (response) {
            $("#npsQuestionContent").empty();

            let pollquestions;
            sumary = response.sumary;
            finish = response.endPoll;

            if (finish) {
                saveFinishQuestion(exampleSaveQuestion);
            } else {
                pollquestions = response.pollquestions.data[0];
                typeQuestion = pollquestions.response_type_id;
                currentPage = response.pollquestions.current_page;
                questionId = pollquestions.id;
                catId = pollquestions.category_id;
                deepening = pollquestions.needs_deepening

                contextTemplate = {
                    pollquestions: pollquestions,
                    category: categories[pollquestions.category_id]
                };

                validateTypeQuestion(typeQuestion, contextTemplate);
                ValidateColorCategories(pollquestions.category_id);

            }
        });
    }
    // else {
    //     finishPoll();
    // }
}

function saveFinishQuestion(data) {

    let getData = getDataAjax(
        "/happindex/pollReplay/saveQuestion/" + poll.id,
        "post",
        data
    );
    getData.done(function (response) {

        let contextTemplate = {
            sumary: response.sumary
        };

        if (poll_active_resumen === 0 || (poll_active_resumen === 1 && response === "")) {
            $('.listCategories').addClass('d-none');
            $(".jumboton-custom").addClass("d-none");
            $('.title-header').addClass('d-none');
            $('.text-finish').removeClass('d-none');
        } else {
            $("#npsQuestionContent").append(
                templateHB("npsResumen", contextTemplate)
            );

            ValidateColorCategories(6);
            validateFinishCategorie(6);
        }


    });
}

function finishPoll() {
    let getData = getDataAjax(
        "/happindex/pollReplay/getInitiative/" +
        npsAnswersHeader.poll_id +
        "/" +
        npsAnswersHeader.id,
        "get",
        null
    );
    getData.done(function (response) {
        let contextTemplate = {
            iniciative: response.data
        };

        $("#iniciativeContent").empty().append(
            templateHB("iniciativeTemplate", contextTemplate)
        );
        $("#iniciatives").modal("show");
    });
}

function saveSegmentation() {
    let data = {
        country: $("#country").val(),
        area: $("#area").val(),
        age: $("#age").val(),
        antiquity: $("#antiquity").val(),
        band: $("#band").val(),
        npsAnswersHeader: npsAnswersHeader
    };

    let getData = getDataAjax(
        "/happindex/pollReplay/saveQuestionSegmentation/" + npsAnswersHeader.id,
        "post",
        data
    );
    getData.done(function (response) {
        $(".btn-loading").addClass("d-none");
        $(".btn-sub").removeClass("d-none");
        $("#initial-question").addClass("d-none");
        $("#feelings-today").removeClass("d-none");
    });
    $(".btn-loading").addClass("d-none");
    $(".btn-sub").removeClass("d-none");
}

function saveInteresed() {
    let data = {
        name: $("#name").val(),
        email: $("#email").val(),
        npsAnswersHeader: npsAnswersHeader
    };

    finish = false;

    let getData = getDataAjax(
        "/happindex/pollReplay/saveInteresed/" + npsAnswersHeader.id,
        "post",
        data
    );
    getData.done(function (response) {
        $(".btn-loading").addClass("d-none");
        $(".btn-sub").removeClass("d-none");

        //$("#finishModal").modal("show");
        $("#interestedModal").modal("hide");
    });
    $(".btn-loading").addClass("d-none");
    $(".btn-sub").removeClass("d-none");
}

function saveFeeling() {
    let data = {
        question_feeling: valueFeelings
    };

    let getData = getDataAjax(
        "/happindex/pollReplay/saveQuestionFelling/" + npsAnswersHeader.id,
        "post",
        data
    );
    getData.done(function (response) {
        $("#segmentation").modal("hide");
        getQuestion();
    });
}

function ValidateColorCategories(categorie) {
    $(".card-custom ").attr(
        "style",
        "border-radius: 25px !important; box-shadow: 25px 17px 28px -2px #cfcece; !important"
    );

    switch (categorie) {
        case 1:
            $("body .content-color").attr(
                "style",
                "background-color: #22B573 !important; border-radius: 25px;"
            );

            $(".custom-1").attr(
                "style",
                " border: 1px solid #22B573 !important; box-shadow: 25px 17px 54px -20px #22b573;"
            );

            break;
        case 2:
            $("body .content-color").attr(
                "style",
                "background-color: #FD7752 !important; border-radius: 25px;"
            );

            $(".custom-2").attr(
                "style",
                " border: 1px solid #FD7752 !important; box-shadow: 25px 17px 54px -20px #FD7752;"
            );

            break;
        case 3:
            $("body .content-color").attr(
                "style",
                "background-color: #FBB03B !important; border-radius: 25px;"
            );

            $(".custom-3").attr(
                "style",
                " border: 1px solid #FBB03B !important; box-shadow: 25px 17px 54px -20px #FBB03B;"
            );

            break;
        case 4:
            $("body .content-color").attr(
                "style",
                "background-color: #2BC3C9 !important; border-radius: 25px;"
            );

            $(".custom-4").attr(
                "style",
                " border: 1px solid #2BC3C9 !important; box-shadow: 25px 17px 54px -20px #2BC3C9;"
            );

            break;
        case 5:
            $("body .content-color").attr(
                "style",
                "background: #7B2E98 !important; border-radius: 25px;"
            );

            $(".custom-5").attr(
                "style",
                " border: 1px solid #7B2E98 !important; box-shadow: 25px 17px 54px -20px #7B2E98;"
            );

            break;
        case 6:
            $("body .content-color").attr(
                "style",
                "background-color: #1C205A !important; border-radius: 25px;"
            );

            $("body .title-left").attr(
                "style",
                "color: #ffff; font-family: Montserrat;font-size: 19px;"
            );

            $(".custom-6").attr(
                "style",
                " border: 1px solid #1C205A !important; box-shadow: 25px 17px 54px -20px #1C205A;"
            );

            break;

        default:
            break;
    }
}

function validateTypeQuestion(typeQuestion, contextTemplate) {
    switch (typeQuestion) {
        case 1:
            $("#npsQuestionContent").append(
                templateHB("npsQuestionT1Template", contextTemplate)
            );
            break;

        case 2:
            $("#npsQuestionContent").append(
                templateHB("npsQuestionT2Template", contextTemplate)
            );
            break;

        case 3:
            $("#npsQuestionContent").append(
                templateHB("npsQuestionT3Template", contextTemplate)
            );
            break;
        case 4:
            $("#npsQuestionContent").append(
                templateHB("npsQuestionT4Template", contextTemplate)
            );
            break;
        case 5:
            $("#npsQuestionContent").append(
                templateHB("npsQuestionT5Template", contextTemplate)
            );
            break;

        default:
            break;
    }
}

function validateFinishCategorie(categorie) {
    switch (categorie) {
        case 1:
            $(".check-1").removeClass("d-none");

            break;
        case 2:
            $(".check-2").removeClass("d-none");
            break;
        case 3:
            $(".check-3").removeClass("d-none");
            break;
        case 4:
            $(".check-4").removeClass("d-none");
            break;
        case 5:
            $(".check-5").removeClass("d-none");
            break;
        case 6:
            $(".check-6").removeClass("d-none");

            break;

        default:
            break;
    }
}
