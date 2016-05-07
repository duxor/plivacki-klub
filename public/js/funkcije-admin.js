$( function(){ $('[data-toggle=tooltip]').tooltip() } )
function prikaziDodatke(dodaciElement){
    if (dodaciElement.files && dodaciElement.files[0]){
        $('#izabraniDodaci').html('');
        for(var i=0; i<dodaciElement.files.length; i++){
            var reader = new FileReader();
            reader.onload = (function(file){return function(e){ $('#izabraniDodaci').append('<li>'+escape(file.name)+'</li>') }})(dodaciElement.files[i]);
            reader.readAsDataURL(dodaciElement.files[i])
        }
    }
}
function unesiFoto(){ $('[name=foto]').click() }
function prikaziFoto(fotoFajl){
    if(fotoFajl.files && fotoFajl.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) { $('#naslovnaFoto').attr('src',e.target.result) }
        reader.readAsDataURL(fotoFajl.files[0])
    }
}