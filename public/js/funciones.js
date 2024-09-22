function buscador(){
    if(document.getElementById('b').value == 0){
        return false
    }
    window.location = '/adm/pedidos?b=' + document.getElementById('b').value;
}