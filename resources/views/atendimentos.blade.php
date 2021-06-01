@extends('layouts.app')

@section('css')
    <style>
        #btn-novo-atendimento{
            float: right;
        }
        .btn-table{
            color: gray;
        }

        form > .row {
            margin-bottom: 10px;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>
                    Atendimentos
                    <button class="btn btn-light" id="btn-novo-atendimento" data-bs-toggle="modal" data-bs-target="#modalAtendimento">Novo Atendimento</button>
                </h2>
                <hr>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-stripped table-hover table-responsive" id="table_atendimentos" style="width: 100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Paciente</th>
                            <th>Profissional</th>
                            <th>Data Atendimento</th>
                            <th>Status</th>
                            <th>Valor</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>

        </div>

        <div class="modal fade" id="modalAtendimento" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalAtendimentoLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAtendimentoLabel">Novo Atendimento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_atendimento">
                        <input type="hidden" name="id_atendimento" id="id_atendimento">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Profissional</label>
                                <select class="" name="profissional" id="profissional" style="width: 100%">
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="">Paciente</label>
                                <select class="form-control" name="paciente" id="paciente" style="width: 100%">
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="">Data/Hora</label>
                                <input class="form-control" type="datetime-local" name="data_hora_atendimento" id="data_hora_atendimento">
                            </div>
                        </div>
                        <div class="row" id="row_procedimento">
                            <div class="col-md-9 form-group">
                                <label for="">Procedimento</label>
                                <input class="form-control" type="text" name="nome_procedimento[]">
                            </div>
                            <div class="col-md-2 form-group">
                                <label for="">Valor</label>
                                <input class="form-control" type="number" name="valor_procedimento[]">
                            </div>
                            <div class="col-md-1 form-group">
                                <label for=""></label>
                                <a onclick="remove_row_procedimento(this)"><span class="material-icons" style="float: left">delete</span></a>
                            </div>
                        </div>
                        
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalResumoAtendimento" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalResumoAtendimentoLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalResumoAtendimentoLabel">Novo Atendimento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>    

  
    

@endsection
@section('javascript')
    <script>
        $(document).ready(async () => {
            // cria instancia da tabela
            let table = $("#table_atendimentos").DataTable({
                ajax: {
                    url: 'api/atendimento',
                    type: 'GET',
                    dataSrc: function(callback){
                        let resposta = []
                        // percorre os dados de resposta e adiciona dados ao array resposta
                        callback.data.forEach(atendimento => {
                            resposta.push({
                                id: atendimento.id,
                                paciente: atendimento.paciente ? atendimento.paciente.nome : '',
                                profissional: atendimento.profissional ? atendimento.profissional.nome : '',
                                data: atendimento.data_hora_atendimento ? atendimento.data_hora_atendimento : '',
                                status: atendimento.finalizado ? atendimento.finalizado : 0,
                                valor: atendimento.valor ? atendimento.valor : 0,
                                acoes: `
                                    <a class="btn btn-table" onclick="get_atendimento(${atendimento.id})" title="Editar Atendimento"><span class="material-icons">edit</span></a>
                                    <a class="btn btn-table" onclick="delete_atendimento(${atendimento.id})" title="Deletar Atendimento"><span class="material-icons">delete</span></a>
                                    <a class="btn btn-table" onclick="finalizar_atendimento(${atendimento.id})" title="Finalizar Atendimento"><span class="material-icons">check_circle</span></a>
                                `
                            });
                        });
                        // retorn resposta
                        return resposta;
                    }
                },
                columns: [
                    {'data': 'id'},
                    {'data': 'paciente'},
                    {'data': 'profissional'},
                    {
                        'data': 'data',
                        'render' : function(data){
                            if(data){
                                let arrayDataHora = data.split(' ');
                                let arrayData = arrayDataHora[0].split('-');
 
                                return `${arrayData[2]}/${arrayData[1]}/${arrayData[0]} ${arrayDataHora[1]}`;
                            }else{
                                return '';
                            }
                        }
                    },
                    {
                        'data': 'status',
                        'render': function(status) {
                            if(status){
                                return `<span class="badge bg-light text-dark">Finalizado</span>`;
                            }else{
                                return `<span class="badge bg-secondary">Aguardando</span>`;
                            }
                        }
                    },
                    {
                        'data': 'valor',
                        'render': function(valor) {
                            return formatar_moeda_brasileira(valor);
                        }
                    },
                    {'data': 'acoes'},
                ],
                oLanguage: {
                    "sProcessing":   "Processando...",
                    "sLengthMenu":   "Mostrar _MENU_ registros",
                    "sZeroRecords":  "Nenhum resultado encontrado",
                    "sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    "sInfoEmpty":    "Mostrando de 0 até 0 de 0 registros",
                    "sInfoFiltered": "",
                    "sInfoPostFix":  "",
                    "sSearch":       "Buscar:",
                    "sUrl":          "",
                    "oPaginate": {
                        "sFirst":    "Primeiro",
                        "sPrevious": "Anterior",
                        "sNext":     "Seguinte",
                        "sLast":     "Último"
                    }
                }
            });

            // cria instancia do select de profissionais
            $("#profissional").select2({
                placeholder: 'Selecione o Profissional',
                allowClear: true,
                dropdownParent: $("#modalAtendimento")
            });
            // cria instancia do select de pacientes
            $("#paciente").select2({
                placeholder: 'Selecione o Paciente',
                allowClear: true,
                dropdownParent: $("#modalAtendimento")
            });

            initialize_selects();
        });

        /**
            Função que retorna os profissionais cadastrados
            @returns {Promise}
        */
        async function get_profissionais(){
            return new Promise((resolve, reject) => {
                $.getJSON('api/profissional', callback => {
                    resolve(callback);
                })
                .fail(error => {
                    reject(error);
                });
            })
        }

        /**
            Função que retorna os pacientes cadastrados
            @returns {Promise}
        */
        async function get_pacientes(){
            return new Promise((resolve, reject) => {
                $.getJSON('api/paciente', callback => {
                    resolve(callback);
                })
                .fail(error => {
                    reject(error);
                });
            })
        }

        /*
            Função que inicializa os selects de pacientes e profissionais
        */
        async function initialize_selects(){
            // busca profissionais e pacientes para montar as opcoes dos selects
            Promise.all([
                get_profissionais().catch(error => {return error}),
                get_pacientes().catch(error => {return error})
            ]).then(valores => {
                const profissionais = valores[0];
                const pacientes = valores[1];
                $("#profissional").html(return_html_options(profissionais)).trigger('change');
                $("#paciente").html(return_html_options(pacientes)).trigger('change');
                
            }).catch(error => {
                console.error(error);
            })
        }

        /**
            Função que recebe um objeto e retorna uma string com as opções do select para ser exibido na view
            @param {Object}
            @returns {String}
        */
        function return_html_options({data}){
            let options = '<option></option>';
            if(data){
                data.forEach(d => {
                    options += `<option value="${d.id}">${d.nome}</option>`;
                });
            }
            return options;
        }

        /*
            Função que recebe um valor e retorna formatado na moeda brasileira
            @param {Float}
            @returns {String}
        */
        function formatar_moeda_brasileira(valor){
            try {
                return valor.toLocaleString('pt-br', {style: 'currency', currency: 'BRL'});
            } catch (error) {
                console.error(error);
                return valor;
            }
        }

        function get_atendimento(id){
            $.ajax({
                url: 'api/atendimento/'+id,
                type: 'GET',
                success: function(callback){
                    if(callback.data){
                        console.log(callback);
                    }
                },
                error: function(error){
                    console.error(error);
                    alert('Não foi possível buscar o atendimento! Tente novamente mais tarde.')
                }
            });
        }
        function delete_atendimento(id){
            $.ajax({
                url:'api/atendimento/'+id,
                type:'DELETE',
                success: function(callback){

                },
                error: function(error){
                    console.error(error);
                    alert('Não foi possível remover o atendimento! Tente novamente mais tarde.')
                }
            })
        }

        $("#form_atendimento").submit(function(event){
            event.preventDefault();

            if($("#id_atendimento")){
                update_atendimento();
            }else{
                create_atendimento();
            }
        });

        /*
            Função que atualiza o atendimento
        */
        function update_atendimento(){

        }
        /*
            Função que cadastra um novo atendimento
        */
        function create_atendimento(){

        }
        /*
            Função que retorna dados do formulário
        */
        function get_form_data(){
            return {

            };
        }

        /*Função que remore linha do procedimento*/
        function remove_row_procedimento(context){
            
        }

        function finalizar_atendimento(id){
            if(confirm('Você tem certeza que deseja finalizar o atendimento?')){
                $.ajax({
                    url: 'api/atendimento/finalizar/'+id,
                    type: 'PUT',
                    success: function(callback){
                        alert('Atendimento finalizado com sucesso!');
                        table.ajax.reload();
                    },
                    error: function(error) {
                        console.error(error);
                        alert('Erro ao finalizar atendimento! Tente novamente mais tarde.')
                    }
                });
            }
        }
    </script>
@endsection
