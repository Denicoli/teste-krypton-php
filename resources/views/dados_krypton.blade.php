<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>

<div class="text-right">
    <button onclick="abrirModalAdicionar()" class="btn btn-primary mt-2 mb-2 mr-4">
        Adicionar
        <span class="iconify" data-icon="mdi:plus" data-inline="false"></span>
    </button>
</div>
<input id="ultimoId" type="hidden" value="{{ $totalCarros }}">
<table class="table table-bordered">
  <tr>
    <th>ID</th>
    <th>Marca</th>
    <th>Modelo</th>
    <th>Cor</th>
    <th>Motor</th>
    <th>Ação</th>
  </tr>
  @foreach($carros as $carro)
  <tr id="{{ $carro->id }}">
    <td> {{ $carro->id }} </td>
    <td> {{ $carro->marca }} </td>
    <td> {{ $carro->modelo }} </td>
    <td> {{ $carro->cor }} </td>
    <td> {{ $carro->motor }} </td>
    <td>
        <button onclick="excluir({{ $carro->id  }})" class="btn btn-danger">
            Excluir
            <span class="iconify" data-icon="mdi:delete-forever" data-inline="false"></span>
        </button>
    </td>
  </tr>
  @endforeach
</table>
<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
<script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    var elements = document.getElementsByTagName("INPUT");
    for (var i = 0; i < elements.length; i++) {
        elements[i].oninvalid = function(e) {
            e.target.setCustomValidity("");
            if (!e.target.validity.valid) {
                e.target.setCustomValidity("O campo é obrigatório");
            }
        };
        elements[i].oninput = function(e) {
            e.target.setCustomValidity("");
        };
    }
})
function excluir(id) {
    $( "#" + id ).remove();
}
var modal_estilos = 'display: block;'
+'width: 85%; max-width: 600px;'
+'background: #fff; padding: 15px;'
+'border-radius: 5px;'
+'-webkit-box-shadow: 0px 6px 14px -2px rgba(0,0,0,0.75);'
+'-moz-box-shadow: 0px 6px 14px -2px rgba(0,0,0,0.75);'
+'box-shadow: 0px 6px 14px -2px rgba(0,0,0,0.75);'
+'position: fixed;'
+'top: 50%; left: 50%;'
+'transform: translate(-50%,-50%);'
+'z-index: 99999999; text-align: center';
var fundo_modal_estilos = 'top: 0; right: 0;'
+'bottom: 0; left: 0; position: fixed;'
+'background-color: rgba(0, 0, 0, 0.6); z-index: 99999999;'
+'display: none;';
var meu_modal = '<div id="fundo_modal" style="'+fundo_modal_estilos+'">'
+'<div id="meu_modal" style="'+modal_estilos+'">'
   +'<h5>Criar novo carro</h5><br />'
      +'<form>'
         +'<div class="row">'
            +'<div class="col-sm-12">'
               +'<div class="form-group">'
                  +'<input id="marca"  name="marca" class="form-control" placeholder="Marca" required/>'
               +'</div>'
               +'<div class="form-group">'
                  +'<input id="modelo"  name="modelo" class="form-control" placeholder="Modelo" required/>'
               +'</div>'
               +'<div class="form-group">'
                  +'<input id="cor"  name="cor" class="form-control" placeholder="Cor" required/>'
               +'</div>'
               +'<div class="form-group">'
                  +'<input id="posicionamento_cilindros"  name="posicionamento_cilindros" class="form-control" placeholder="Posicionamento cilindros" required/>'
               +'</div>'
               +'<div class="form-group">'
                  +'<input id="cilindros"  name="cilindros" class="form-control" placeholder="Cilindros" required/>'
               +'</div>'
               +'<div class="form-group">'
                  +'<input id="litragem"  name="litragem" class="form-control" placeholder="Litragem" required/>'
               +'</div>'
               +'<div class="form-group">'
                  +'<input id="observacao"  name="observacao" class="form-control" placeholder="Obs:"/>'
               +'</div>'
               +'<div class="form-group">'
                  +'<button style="float: left; margin-left: 15px;" type="submit" class="btn btn-secondary">Adicionar</button>'
               +'</div>'
            +'</div>'
         +'</div>'
      +'</form>'
   +'<button type="button" class="close" style="top: 5px; right: 10px; position: absolute; cursor: pointer;"><span>&times;</span></button>'
+'</div></div>';
$("body").append(meu_modal);
$("#fundo_modal, .close").click(function(){ $("#fundo_modal").hide(); });
$("#meu_modal").click(function(e){ e.stopPropagation(); });
$(document).ready(function() {
    $("form").submit(function(e){
        e.preventDefault(e);
        objeto = trataDadosForm()
        adicionaRegistro(objeto)
        escondeModal()
        exibeAlert()
        limpaCamposModal()
    });
});

function limpaCamposModal() {
    $("#marca").val("")
    $("#modelo").val("")
    $("#cor").val("")
    $("#posicionamento_cilindros").val("")
    $("#cilindros").val("")
    $("#litragem").val("")
    $("#observacao").val("")
}

function escondeModal() {
    $("#fundo_modal").hide()
}

function exibeAlert() {
    alert("Cadastrado com sucesso")
}

function adicionaRegistro(objeto) {
    let novoCarro = '<tr id="' +  objeto.id + '">'
    novoCarro += '<td>' + objeto.id + '</td>'
    novoCarro += '<td>' + objeto.marca + '</td>'
    novoCarro += '<td>' + objeto.modelo + '</td>'
    novoCarro += '<td>' + objeto.cor + '</td>'
    novoCarro += '<td>' + objeto.motor + '</td>'
    novoCarro += '<td>'
    novoCarro += '<button onclick="excluir(' + objeto.id + ')" class="btn btn-danger">'
    novoCarro += 'Excluir'
    novoCarro += '<span class="iconify" data-icon="mdi:delete-forever" data-inline="false"></span>'
    novoCarro += '</button>'
    novoCarro += '</td>'
    novoCarro += '</tr>'
    $( ".table" ).append( novoCarro )
    $("#ultimoId").val(objeto.id)
}

function trataDadosForm() {
    let data = $('form').serializeArray()
    let ultimoId = $("#ultimoId").val()
    let objeto = {}
    data.map(item => {
        objeto[item.name] = item.value
    })
    let posicionamento_cilindros = "Posicionamento cilindros: " + objeto.posicionamento_cilindros;
    let cilindros = "quantidade cilindros: " + objeto.cilindros;
    let litragem = "litragem: " + objeto.litragem;
    let observacao = "observação: " + (objeto.observacao ? objeto.observacao : "-");
    objeto.motor = posicionamento_cilindros + ", " + cilindros + ", " + litragem + ", " + observacao;
    objeto.id = parseInt(ultimoId) + 1
    return objeto
}

function abrirModalAdicionar(){
    $('#fundo_modal').show()
}

</script>