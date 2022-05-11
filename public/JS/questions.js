let acountPage = 1;
let questionVal;
let valueFeelings;
let idQuestion;
let lastPage = 1;
let idPoll;
let questions = []
let data = {}

$(function () {


    $("#introModalQuestion").modal("show");

    $("#pollInitQuestion").on("click", function () {
        $("#introModalQuestion").modal("hide");
        $("#segmentation").modal("show");
    });

    $(".feeling-btn").on("click", function () {

        $("#segmentation").modal("hide")
        getQuestion();
    });


    $("input[name='feeling']").on("change", function () {
        $(".feeling-btn").prop("disabled", false);
        valueFeelings = $(this).val();
    });
 
    $("body").on("click", ".next-question", function () {
        acountPage++;
        $("body .next-question").prop("disabled", true).html('<span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span> Cargando...');
        $("body .spinner-border").removeClass("d-none");
        setTimeout(function () {
            getQuestion();
        }, 300);
    });

    $(document).on("input change", ".custom-range", function () {
        $(".range-img").attr(
            "src",
            "/images/icon-range-" + $(this).val() + ".svg"
        );
        $(".range-value").html($(this).val());
        $("body .next-question").prop("disabled", false);
        questionVal = $(this).val();
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

        console.log($("#" + input).val())

        if (
            id == "ta-" ||
            id == "td-" ||
            id == "nda-"||
            id == "dc-" ||  
            id == "da-"
        ) {
            $(this)
                .find("label")
                .attr("style", "color: #ffff ");
            $(this).attr("style", "background-color: #EA6C00 ");
        }
        $("body .next-question").prop("disabled", false);
    });
});



function getQuestion() {

    if (questionVal !== undefined) {
        questions.push({
            id: idQuestion,
            response: questionVal
        })

        data = {
            "idPoll": idPoll,
            "feeling": valueFeelings,
            "questions": questions
        }
    }


    if (acountPage <= lastPage) {

        let getData = getDataAjax(
            "/api/send-poll/HRAac33jsMIJJ0o?page=" + acountPage,
            "get",
            null
        );
        getData.done(function (response) {
            $("#npsQuestionContent").empty();
            console.log(response)
            let contextTemplate = response.data[0]
            lastPage = response.total
            idPoll = response.data[0].idPolls
            idQuestion = response.data[0].idQuestions
            validateTypeQuestion(response.data[0].type, contextTemplate)
        });
    } else {
        finishPoll()
    }

}


function finishPoll() {

    let getData = getDataAjax(
        "/api/send-poll",
        "post",
        data
    );
    getData.done(function (response) {
        console.log(response)

        $('.title-header').addClass('d-none')
        $("#npsQuestionContent").empty();
        $("#npsQuestionContent").append(
            templateHB("npsQuestionT5Template", null)
        );
    });
}


function validateTypeQuestion(typeQuestion, contextTemplate) {

    switch (parseInt(typeQuestion)) {
        case 1:
            console.log('entro')
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
        default:
            console.log('entro final')
            break;
    }
}

