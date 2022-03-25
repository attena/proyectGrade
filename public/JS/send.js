let idPoll;
let namePoll;

$(function () {

     //getSample()

    $('.btn-firts').on('click', function () {

        $('.first-step').addClass('d-none')
        $('.second-step').removeClass('d-none')
        $('.progress-bar').attr('style', 'width:50%; background-image: radial-gradient(circle at -20.26% 56.15%, #fffc5a 0, #fffb50 12.5%, #e8f848 25%, #d0f641 37.5%, #b5f23c 50%, #98ee3a 62.5%, #77ea3d 75%, #4de743 87.5%, #00e34c 100%);');
    })

    $('.btn-second').on('click', function () {

        $('.second-step').addClass('d-none')
        $('.three-step').removeClass('d-none')
        $('.progress-bar').attr('style', 'width:75%; background-image: radial-gradient(circle at -20.26% 56.15%, #fffc5a 0, #fffb50 12.5%, #e8f848 25%, #d0f641 37.5%, #b5f23c 50%, #98ee3a 62.5%, #77ea3d 75%, #4de743 87.5%, #00e34c 100%);');
    })

    $('.btn-three').on('click', function () {

        $('.three-step').addClass('d-none')
        $('.final-step').removeClass('d-none')
        $('.progress-bar').attr('style', 'width:100%; background-image: radial-gradient(circle at -20.26% 56.15%, #fffc5a 0, #fffb50 12.5%, #e8f848 25%, #d0f641 37.5%, #b5f23c 50%, #98ee3a 62.5%, #77ea3d 75%, #4de743 87.5%, #00e34c 100%);');

        let fechaI = $('input[name=dateInit-poll]').val().split('T')
        let fechaF = $('input[name=dateFinish-poll]').val().split('T')
        
        $('body input[name=id-samples-poll]').each(function (indice, chk) {
            if ($(chk).is(':checked')) {
                $('.sample-name').append($(chk).attr('data-name'),', ')
            }
        });

        $('.pulse-name').html($('input[name=name-poll]').val())
        $('.date-init').html(fechaI[0]+' '+fechaI[1]) 
        $('.date-end').html(fechaF[0]+' '+fechaF[1])
        $('.poll-name').html(namePoll)
    })



    $('.back-second').on('click', function () {

        $('.first-step').removeClass('d-none')
        $('.second-step').addClass('d-none')
        $('.progress-bar').attr('style', 'width:25%; background-image: radial-gradient(circle at -20.26% 56.15%, #fffc5a 0, #fffb50 12.5%, #e8f848 25%, #d0f641 37.5%, #b5f23c 50%, #98ee3a 62.5%, #77ea3d 75%, #4de743 87.5%, #00e34c 100%);' );
    })

    $('.back-three').on('click', function () {

        $('.second-step').removeClass('d-none')
        $('.three-step').addClass('d-none')
        $('.progress-bar').attr('style', 'width:50%; background-image: radial-gradient(circle at -20.26% 56.15%, #fffc5a 0, #fffb50 12.5%, #e8f848 25%, #d0f641 37.5%, #b5f23c 50%, #98ee3a 62.5%, #77ea3d 75%, #4de743 87.5%, #00e34c 100%);');

    })

    $('.back-final').on('click', function () {

        $('.three-step').removeClass('d-none')
        $('.final-step').addClass('d-none')
        $('.progress-bar').attr('style', 'width:75%; background-image: radial-gradient(circle at -20.26% 56.15%, #fffc5a 0, #fffb50 12.5%, #e8f848 25%, #d0f641 37.5%, #b5f23c 50%, #98ee3a 62.5%, #77ea3d 75%, #4de743 87.5%, #00e34c 100%);');
    })


    $('body').on('change', 'input[name=encuesta-list]', function () {

        if ($(this).is(':checked')) {

            idPoll = $(this).val()
            namePoll = $(this).attr('data-name')
            $('body input[name=encuesta-list]').each(function (indice, chk) {
                if ($(chk).is(':checked')) {
                    $(chk).prop("disabled", false);
                } else {
                    $(chk).prop("disabled", true);
                }
            });
        } else {
            $('body input[name=encuesta-list]').prop("disabled", false);
        }

    });

    $('.btn-final-poll').on('click', function(){
        savePolls()
    })


})

function savePolls() {

    let samples = []
    $('body input[name=id-samples-poll]').each(function (indice, chk) {
        if ($(chk).is(':checked')) {
            samples.push({'id':$(chk).val()})
        }
    });

    let fechaI = $('input[name=dateInit-poll]').val().split('T')
    let fechaF = $('input[name=dateFinish-poll]').val().split('T')

    let data = {
        "name": $('input[name=name-poll]').val(),
        "start_date": fechaI[0]+' '+fechaI[1],
        "end_date": fechaF[0]+' '+fechaF[1],
        "samples": samples,
        "polls": [{ "id": idPoll }]
    }

    console.log(data)

    let getData = getDataAjax(
        "/happindex/api/pulse",
        "POST", 
        data
    );

    getData.done(function(response) {

        if(response){
            $('.save-poll').removeClass('d-none')
        }else{
            $('.fail-poll').removeClass('d-none')
        }

    });
}

function getSample(){

    let getData = getDataAjax(
        "/happindex/api/samples",
        "GET"
    );

    getData.done(function(response) {

        $('.hiden-tr').addClass('d-none')
        if(response.length > 0){
            listSamples(response)
        }else{
            $('.add-list-samples-poll').html('<tr class="text-muted no-register"><td colspan="4" class="text-center">No se encontrarón muestras registradas</td></tr>')
        }

    });

}

function listSamples(data){

    data.forEach(element => {
        $('.add-list-samples-poll').append(
            '<tr class="text-muted list-sample">'
                +'<td class="name-sample">'+element.name+'</td>'
                +'<td>'+element.count+'</td>'
                +'<td>'+element.created_at+'</td>'
                +'<td><input type="checkbox" data-name="'+element.name+'" name="id-samples-poll" value="'+element.id+'"></td>'
            +'</tr>')
    });
}