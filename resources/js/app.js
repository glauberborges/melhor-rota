//require('./bootstrap');

$(document).ready(function(){
    $('.file-input').change(function(e){
        const fileName = e.target.files[0].name;
        $('.dropzone-title').html('Arquivo  <span class=\'browse\'> '+ fileName +'</span>   foi selecionado.')
    });
});
