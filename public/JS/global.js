function getDataAjax(url, method, parameters) {
    return $.ajax({
      type: method,
      async:false,
      cache:false,
      headers: { 'X-CSRF-TOKEN':  $('meta[name="csrf-token"]').attr('content') },    
      url: url,
      data: parameters,
      dataType: 'json',
      accepts: "application/json",
      crossDomain: true
    })
    .fail(function() {
      console.log('Error en getDataAjax');
    })
    .always(function() {
      
    });
}


function templateHB(templateId, data){
    var theTemplateScript = $("#"+templateId).html();
    var theTemplate = Handlebars.compile(theTemplateScript);
    return theTemplate(data);
}



