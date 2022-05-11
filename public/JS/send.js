let idPoll;
let namePoll;

$(function () {


    $('.btn-firts').on('click', function () {

        $('.first-step').addClass('d-none')
        $('.second-step').removeClass('d-none')
        $('.progress-bar').attr('style', 'width:75%; background-image: radial-gradient(circle at -20.26% 56.15%, #fffc5a 0, #fffb50 12.5%, #e8f848 25%, #d0f641 37.5%, #b5f23c 50%, #98ee3a 62.5%, #77ea3d 75%, #4de743 87.5%, #00e34c 100%);');
    })

    $('.btn-second').on('click', function () {

        $('.second-step').addClass('d-none')
        $('.final-step').removeClass('d-none')
        $('.progress-bar').attr('style', 'width:100%; background-image: radial-gradient(circle at -20.26% 56.15%, #fffc5a 0, #fffb50 12.5%, #e8f848 25%, #d0f641 37.5%, #b5f23c 50%, #98ee3a 62.5%, #77ea3d 75%, #4de743 87.5%, #00e34c 100%);');


        $('.file-mails').html($('input[name=emails]').prop('files')[0].name)
        $('.poll-name').html(namePoll)
    })

    $('.back-second').on('click', function () {

        $('.first-step').removeClass('d-none')
        $('.second-step').addClass('d-none')
        $('.progress-bar').attr('style', 'width:25%; background-image: radial-gradient(circle at -20.26% 56.15%, #fffc5a 0, #fffb50 12.5%, #e8f848 25%, #d0f641 37.5%, #b5f23c 50%, #98ee3a 62.5%, #77ea3d 75%, #4de743 87.5%, #00e34c 100%);');
    })


    $('.back-final').on('click', function () {

        $('.second-step').removeClass('d-none')
        $('.final-step').addClass('d-none')
        $('.progress-bar').attr('style', 'width:75%; background-image: radial-gradient(circle at -20.26% 56.15%, #fffc5a 0, #fffb50 12.5%, #e8f848 25%, #d0f641 37.5%, #b5f23c 50%, #98ee3a 62.5%, #77ea3d 75%, #4de743 87.5%, #00e34c 100%);');
    })


    $('body').on('change', 'input[name=polls-list]', function () {

        if ($(this).is(':checked')) {

            $('.btn-second').prop("disabled", false);
            idPoll = $(this).val()
            namePoll = $(this).attr('data-name')
            $('body input[name=polls-list]').each(function (indice, chk) {
                if ($(chk).is(':checked')) {
                    $(chk).prop("disabled", false);
                } else {
                    $(chk).prop("disabled", true);
                }
            });
        } else {
            $('body input[name=polls-list]').prop("disabled", false);
            $('.btn-second').prop("disabled", true);
        }

    });

    $('body').on('change', 'input[name=emails]', function () {



        if($(this).val() != ""){
            $('.btn-firts').prop("disabled", false);
        }else{
            $('.btn-firts').prop("disabled", true);
        }

    });

    $('.btn-final-poll').on('click', function () {
        sendsPolls()
    })


})



function sendsPolls() {

    var formData = new FormData()
    formData.append('polls', idPoll)
    formData.append('file', $('input[name=emails]').prop('files')[0])

    $("body .btn-final-poll").prop("disabled", true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Cargando...');

    $.ajax({
        url: "/api/sends", 
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            if(data){
                $(".send-poll").removeClass('d-none')
                $("body .spinner-border").addClass("d-none");
                $("body .btn-final-poll").html('Finalizado');
            }
        },cache(e){
            $(".fail-send").removeClass('d-none')
            
        }
    });
}