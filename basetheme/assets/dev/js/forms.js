// FORMULÁRIOS
//--------------------------------------
$(document).ready(function () {

    // TELEFONE E CELULAR
    //--------------------------------------
    var SPMaskBehavior = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    },
    spOptions = {
        onKeyPress: function(val, e, field, options) {
            field.mask(SPMaskBehavior.apply({}, arguments), options);
        }
    };

    // MASKS
    //--------------------------------------
    $('input[name="telefone"]').mask(SPMaskBehavior, spOptions);
    $('input[name="celular"]').mask(SPMaskBehavior, spOptions);
    $('input[name="cep"]').mask('00000-000');
    $('input[name="cpf"]').mask('000.000.000-00', {reverse: true});
    $('input[name="cnpj"]').mask('00.000.000/0000-00', {reverse: true});
    $('input[name="money"]').mask('000.000.000.000.000,00', {reverse: true});
    $('.date-formated').mask("00/00/0000", {placeholder: "__/__/____"});


    // CIDADE E ESTADO
    //--------------------------------------
    var api = "../wp-content/themes/ceicom/assets/json/city_state.json";
    var db = [];

    function fetchDb(json, cb) {
        $.getJSON(json, function(item) {
            item.estados.forEach(function(geo) {
                db.push(geo);
            })
        }).done(cb);
    }

    function renderEstado() {
        db.forEach(function(item) {
            $(".uf").append('<option value="' + item.sigla + '">' + item.nome + '</option>');
        });
    }

    function renderCity(uf, cidade) {
        var cidades = db.filter((e) =>  e.sigla === uf);

        cidades[0].cidades.forEach(function(nome) {
            cidade.append( '<option value="' + nome + '">' + nome + '</option>' );
        });
    }

    function cleanSelect(select) {
        select.find('option').not(':first').remove();
    }

    fetchDb(api, renderEstado);
    $('.city').attr('disabled', true);

    $('.uf').change(function() {
        var cidade = $('.city');
        var ufid = $(this).val();

        cleanSelect(cidade);
        renderCity(ufid, cidade);
        cidade.attr("disabled", false);
    });
});
