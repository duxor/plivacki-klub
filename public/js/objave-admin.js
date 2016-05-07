$('.ukloniObjavu').click(function(){
    $('#naslovObjave').html('"'+$(this).closest('h2').children('a')[0].text+'"');
    $('#ukloniObjavu').attr('href',$(this).data('href'));
    $('#sigurniSte').modal('show');
})