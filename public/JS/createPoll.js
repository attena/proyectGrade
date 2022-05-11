let dataResponse;
let idPollList;

$(function () {

    getPolls()
    

    $('body').on('change', 'input[name=polls-list]', function () {

        if ($(this).is(':checked')) {

            idPollList = $(this).val()
            namePoll = $(this).attr('data-name')
            localStorage.setItem("idPoll", $(this).val());
            $('body input[name=polls-list]').each(function (indice, chk) {
                if ($(chk).is(':checked')) {
                    $(chk).prop("disabled", false);
                } else {
                    $(chk).prop("disabled", true);
                }
            });

            $('.hidden-btns').removeClass("d-none")

        } else {
            $('body input[name=polls-list]').prop("disabled", false);
            $('.hidden-btns').addClass("d-none")
        }

    });

    

    $(document).on("input change", ".custom-range", function () {
        $(".range-img").attr(
            "src",
            "/images/icon-range-" + $(this).val() + ".svg"
        );
        $(".range-value").html($(this).val());
    });

    $('.btn-redirect').on('click', function () {
        window.location.href = "/modify/"+idPollList;
    })

    $('.btn-delete-poll').on('click', function () {

        $("#deleteQuestion").modal("show");
    })

    $('#deletePoll').on('click', function () {
        $("#deleteQuestion").modal("hide");
        deletePoll()
    })


    $('.spinner-border').addClass('d-none')
    $('.form-questions').append(templateHB('template-questions', null));


    $("body").on("change", ".type-question", function () {

        $(this).parent().parent().find(".type-1, .type-2, .type-3, .type-4").addClass("d-none");
        $(this).parent().parent().find(".type-0 ").addClass("d-none");



        if ($(this).val() === "1") {
            $(this).parent().parent().find(".type-1").removeClass("d-none")
        }
        if ($(this).val() === "2") {
            $(this).parent().parent().find(".type-2").removeClass("d-none");
        }
        if ($(this).val() === "3") {
            $(this).parent().parent().find(".type-3").removeClass("d-none");
        }
        if ($(this).val() === "4") {
            $(this).parent().parent().find(".type-4").removeClass("d-none");
        }
    });

    $('body').on('click', '.remove-question', function () {
        $(this).parent().parent().parent().parent().parent().parent().remove()
    })


    $('body').on('click', '.add-question', function () {

        $('.form-questions, .form-questions-modify').append(templateHB('template-questions', { dataResponse }));
        $('body .remove-question').removeClass('d-none')
        $('body .remove-question').first().addClass('d-none')
    })

    if(jQuery(location).attr('href') !='http://127.0.0.1:8000/create'){
        getPollCreated()
    }
    

    $("#form-questions").validate({
        ignore: ".ignore",
        rules: {
            'title': {
                required: true
            },
            'question[]': {
                required: true
            },
            'response_type[]': {
                required: true
            }
        },
        messages: {
            'title': {
                required: 'Campo requerido'
            },
            'question[]': {
                required: 'Campo requerido'
            },
            'response_type[]': {
                required: 'Campo requerido'
            },
        },
        submitHandler: function (form) {
            $('.loader-save-questions').removeClass('d-none')
            setTimeout(() => {
                savePoll();
            }, 1000);
        }
    });

    $("#form-questions-modify").validate({
        ignore: ".ignore",
        rules: {
            'title': {
                required: true
            },
            'question[]': {
                required: true
            },
            'response_type[]': {
                required: true
            }
        },
        messages: {
            'title': {
                required: 'Campo requerido'
            },
            'question[]': {
                required: 'Campo requerido'
            },
            'response_type[]': {
                required: 'Campo requerido'
            },
        },
        submitHandler: function (form) {
            $('.loader-save-questions').removeClass('d-none')
            setTimeout(() => {
                modifyPoll();
            }, 1000);
        }
    });

});

function savePoll() {

    let questions = []

    $("body input[name='question[]']").map(function (i, val) {

        questions.push({
            "question": $(this).val(),
            "type": $("body select[name='response_type[]']").eq(i).val(),
        })

    }).get();

    let data = {
        "name": $('input[name=title]').val(),
        "questions": questions
    }

    let getData = getDataAjax(
        "/api/polls",
        "POST",
        data
    );

    getData.done(function (response) {
        $('.loader-save-questions').addClass('d-none')
        $('.save-poll').removeClass('d-none')
    });
}

function getPolls() {

    let getData = getDataAjax(
        "/api/polls",
        "GET"
    );

    getData.done(function (response) {

        $('.hiden-tr').addClass('d-none')
        if (response.length > 0) {
            listPolls(response)
        } else {
            $('.add-list-polls').html('<tr class="text-muted no-register"><td colspan="4" class="text-center">No se encontrarón registros</td></tr>')
        }

    });
}


function listPolls(data) {

    $('.add-list-polls').empty();
    data[0].forEach((element, index) => {
        $('.add-list-polls').append(
            '<tr class="text-muted list-sample">'
            + '<td>' + data[1][index].name + '</td>'
            + '<td>' + element.total + '</td>'
            + '<td>' + data[1][index].date + '</td>'
            + '<td><input type="checkbox" name="polls-list" data-name="'+data[1][index].name+'" value="' + element.idPolls + '"></td>'
            + '</tr>')
    });
}


function deletePoll() {
    let getData = getDataAjax(
        "/api/polls/" + idPollList,
        "DELETE"
    );

    getData.done(function (response) {
        getPolls();
    });
}


function getPollCreated() {

    let idPoll = localStorage.getItem("idPoll")

    let getData = getDataAjax(
        "/api/polls/"+idPoll,
        "GET"
    );

    getData.done(function (response) {

        response.forEach(element => {
            $('.form-questions-modify').append(templateHB('template-questions', { element }));
            $('body .remove-question').removeClass('d-none')
            $('body .remove-question').first().addClass('d-none')

            $('body .question-modify').last().find('type-1')


            $('#title-modify').val(element.name)
            $('#title-modify').attr("data-idPoll", '' + element.idPolls);


            if (element.type === "1") {
                $('body .type-1').last().removeClass("d-none")
                $('body .type-question option[value="1"]').last().attr("selected", "selected")
            }
            if (element.type === "2") {
                $('body .type-2').last().removeClass("d-none");
                $('body .type-question option[value="2"]').last().attr("selected", "selected")
            }
            if (element.type === "3") {
                $('body .type-3').last().removeClass("d-none");
                $('body .type-question option[value="3"]').last().attr("selected", "selected")
            }
            if (element.type === "4") {
                $('body .type-4').last().removeClass("d-none");
                $('body .type-question option[value="4"]').last().attr("selected", "selected")
            }

        });

    });
}

function modifyPoll() {

    let questions = []

    $("body input[name='question[]']").map(function (i, val) {

        questions.push({
            "id": $(this).attr('data-question'),
            "question": $(this).val(),
            "type": $("body select[name='response_type[]']").eq(i).val(),
        })

    }).get();

    let data = {
        "name": $('body #title-modify').val(),
        "questions": questions
    }

    let getData = getDataAjax(
        "/api/polls/" + $('body #title-modify').attr('data-idpoll'),
        "PUT",
        data
    );

    getData.done(function (response) {

        $('.loader-save-questions').addClass('d-none')

        if (response) {
            $('.alert-success').removeClass('d-none')
        } else {
            $('.alert-danger').removeClass('d-none')
        }

    });
}






