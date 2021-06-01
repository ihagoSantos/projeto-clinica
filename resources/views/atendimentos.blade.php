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
        .btn_remove_procedimento{
            cursor: pointer;
            color:gray;
        }
        .btn_remove_procedimento:hover{
            color:black;
            transition: 0.2s;
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
        {{-- modal cadastro/edit atendimento --}}
        <div class="modal fade" id="modalAtendimento" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalAtendimentoLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="form_atendimento">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalAtendimentoLabel">Novo Atendimento</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        
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

                            <div class="row" style="margin-top: 20px">
                                <div class="col-md-12">
                                    <h6>Procedimentos</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-8 form-group">
                                            <label for="">Procedimento</label>
                                            <input class="form-control" type="text" name="nome_procedimento[]" id="nome_procedimento_default" required>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label for="">Valor</label>
                                            <input class="form-control" type="number" name="valor_procedimento[]" id="valor_procedimento_default" step="0.1" min="0.1" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="row_procedimento">
                                
                            </div>

                            <div class="row" style="margin-top:30px">
                                <div class="col-md-12 d-flex justify-content-center">
                                    <button class="btn btn-primary" id="btn_novo_procedimento">Novo Procedimento</button>
                                </div>
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- Modal resumo atendimento --}}
        <div class="modal fade" id="modalResumoAtendimento" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalResumoAtendimentoLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalResumoAtendimentoLabel">Novo Atendimento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="">ID</label>
                                <h5 id="idResumo">-</h5>
                            </div>
                            <div class="col-md-3">
                                <label for="">Valor</label>
                                <h5 id="valorResumo">-</h5>
                            </div>
                            <div class="col-md-3">
                                <label for="">Data</label>
                                <h5 id="dataResumo">-</h5>
                            </div>
                            <div class="col-md-3">
                                <label for="">Paciente</label>
                                <h5 id="pacienteResumo">-</h5>
                            </div>
                            <div class="col-md-3">
                                <label for="">Profissional</label>
                                <h5 id="profissionalResumo">-</h5>
                            </div>
                            <div class="col-md-3">
                                <label for="">Comissão</label>
                                <h5 id="comissaoResumo">-</h5>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-stripped table-hover table-responsive" id="table_procedimentos" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>Procedimento</th>
                                            <th>Valor</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
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
    <script src="https://unpkg.com/dayjs@1.8.21/dayjs.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
    <script>
        const traducao_datatable = {
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
        $(document).ready(async () => {

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
        let table_procedimentos = $("#table_procedimentos").DataTable({
            oLanguage: traducao_datatable,
            columns: [
                {'data': 'nome'},
                {
                    'data': 'valor',
                    'render': function(valor){
                        return formatar_moeda_brasileira(valor);
                    }
                },
            ]
        });
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
                            acoes: getButtonsAcoes(atendimento.id,atendimento.finalizado) 
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
                            return dayjs(data).format('DD/MM/YYYY hh:mm:ss')
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
            oLanguage: traducao_datatable,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'pdfHtml5',
                    title: 'Atendimentos',
                    text: 'PDF',
                    className: 'btn btn-primary',
                    exportOptions: {
                        columns: [0,1,2,3,4,5]
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: 'Atendimentos',
                    text: 'Excel',
                    className: 'btn btn-primary',
                    exportOptions: {
                        columns: [0,1,2,3,4,5]
                    }
                },
                {
                    extend: 'csvHtml5',
                    title: 'Atendimentos',
                    text: 'CSV',
                    className: 'btn btn-primary',
                    exportOptions: {
                        columns: [0,1,2,3,4,5]
                    }
                },
                {
                    extend: 'copyHtml5',
                    title: 'Atendimentos',
                    text: 'Copiar',
                    className: 'btn btn-primary',
                    exportOptions: {
                        columns: [0,1,2,3,4,5]
                    }
                },
            ]
        });

        function getButtonsAcoes(id, finalizado){
            if(!finalizado){
                return `
                    <a class="btn btn-table" onclick="get_atendimento(${id})" title="Editar Atendimento"><span class="material-icons">edit</span></a>
                    <a class="btn btn-table" onclick="delete_atendimento(${id})" title="Deletar Atendimento"><span class="material-icons">delete</span></a>
                    <a class="btn btn-table" onclick="finalizar_atendimento(${id})" title="Finalizar Atendimento"><span class="material-icons">check_circle</span></a>
                `
            }else{
                return ''
            }
        }
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
        // Busca atendimento e exibe o modal com informações para edição
        function get_atendimento(id){
            $.ajax({
                url: 'api/atendimento/'+id,
                type: 'GET',
                success: function(callback){
                    if(callback.data){
                        showAtendimento(callback);
                    }
                },
                error: function(error){
                    console.error(error);
                    alert('Não foi possível buscar o atendimento! Tente novamente mais tarde.')
                }
            });
        }

        // Remove um atendimento
        function delete_atendimento(id){
            $.ajax({
                url:'api/atendimento/'+id,
                type:'DELETE',
                success: function(callback){
                    alert('Atendimento Removido com sucesso!');
                    table.ajax.reload();
                },
                error: function(error){
                    console.error(error);
                    alert('Não foi possível remover o atendimento! Tente novamente mais tarde.')
                }
            })
        }

        $("#form_atendimento").submit(function(event){
            
            event.preventDefault();
            const id_atendimento = $("#id_atendimento").val();
            const data = get_form_data();
            if(validarDadosForm(data)){
                if(id_atendimento && id_atendimento != ''){
                    update_atendimento(id_atendimento, data);
                }else{
                    create_atendimento(data);
                }
            }


        });
        function validarDadosForm(data){

            return true;
        }
        /*
            Função que atualiza o atendimento
        */
        function update_atendimento(id, data){
            $.ajax({
                url: "api/atendimento/"+id,
                type: "PUT",
                dataType:"json",
                data:data,
                success: function(callback){
                    alert("Atendimento atualizado com sucesso!");
                    table.ajax.reload();
                    $("#modalAtendimento").modal('hide');
                },
                error: function(error){
                    console.error(error);
                    alert("Erro ao atualizar atendimento! Tente novamente mais tarde.");
                }
            })
        }
        /*
            Função que cadastra um novo atendimento
        */
        function create_atendimento(data){
            
            $.ajax({
                url: "api/atendimento",
                type: "POST",
                dataType:"json",
                data:data,
                success: function(callback){
                    alert("Atendimento cadastrado com sucesso!");
                    table.ajax.reload();
                    $("#modalAtendimento").modal('hide');
                },
                error: function(error){
                    console.error(error);
                    alert("Erro ao cadastrar atendimento! Tente novamente mais tarde.");
                }
            })
        }

        function showAtendimento({data}){
            $("#id_atendimento").val(data.id);
            $("#profissional").val(data.profissional_id).trigger('change');
            $("#paciente").val(data.paciente_id).trigger('change');
            let array_data_hora = data.data_hora_atendimento.split(" ");
            let data_hora_atendimento = `${array_data_hora[0]}T${array_data_hora[1].split(':')[0]}:${array_data_hora[1].split(':')[1]}`
            $("#data_hora_atendimento").val(data_hora_atendimento);
            set_rows_procedimentos(data)
            $("#modalAtendimento").modal('show');
        }
        /*
            Função que retorna dados do formulário
        */
        function get_form_data(){
            let data = {
                profissional_id: $("#profissional").val(),
                paciente_id: $("#paciente").val(),
                data_hora_atendimento: dayjs($("#data_hora_atendimento").val()).format('YYYY-MM-DD hh:mm:ss'),
                procedimentos: []
            }
            let nomes_procedimentos = $("input[name='nome_procedimento[]']").map(function(){
                return $(this).val();
            }).get();
            let valores_procedimentos = $("input[name='valor_procedimento[]']").map(function(){
                return $(this).val();
            }).get();
            for(let i = 0; i < nomes_procedimentos.length; i++){
                data.procedimentos.push({
                    nome: nomes_procedimentos[i],
                    valor: valores_procedimentos[i]
                })
            }
            
            return data;
        }
        
        /*
            Função que finaliza o atendimento e exibe o resumo em um modal
        */
        function finalizar_atendimento(id){
            if(confirm('Você tem certeza que deseja finalizar o atendimento?')){
                $.ajax({
                    url: 'api/atendimento/finalizar/'+id,
                    type: 'PUT',
                    success: function(callback){
                        alert('Atendimento finalizado com sucesso!');
                        showResumoAtendimento(callback);
                        table.ajax.reload();
                    },
                    error: function(error) {
                        console.error(error);
                        alert('Erro ao finalizar atendimento! Tente novamente mais tarde.')
                    }
                });
            }
        }

        /*
            Exibe resumo do atendimento
        */
        function showResumoAtendimento({data}){
            
            $("#idResumo").html(data.id);
            $("#valorResumo").html(formatar_moeda_brasileira(data.valor));
            $("#dataResumo").html(dayjs(data.data_hora_atendimento).format('DD/MM/YYYY hh:mm:ss'));
            $("#pacienteResumo").html(data.paciente.nome);
            $("#profissionalResumo").html(data.profissional.nome);
            $("#comissaoResumo").html(formatar_moeda_brasileira(data.totalComissao));
            table_procedimentos.clear();
            table_procedimentos.rows.add(data.procedimentos).draw();

            $("#modalResumoAtendimento").modal('show');
        }
        // Adiciona linha do procedimento ao clicar no botão novo procedimento
        $("#btn_novo_procedimento").click(function(){
            $("#row_procedimento").append(get_row_procedimento());
        });


        /*Função que retorna linha do procedimento*/
        function get_row_procedimento(){
            return `
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8 form-group">
                        <label for="">Procedimento</label>
                        <input class="form-control" type="text" name="nome_procedimento[]" required>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">Valor</label>
                        <input class="form-control" type="number" name="valor_procedimento[]" step="0.1" min="0.1" required>
                    </div>
                    <div class="col-md-1 form-group">
                        <label for=""></label>
                        <a class="btn_remove_procedimento" title="Remover Procedimento" onclick="remove_row_procedimento(this)"><span class="material-icons" style="float: left">delete</span></a>
                    </div>
                </div>
            </div>
            `;
        }
        /*Função que retorna linha do procedimento*/
        function set_rows_procedimentos({procedimentos}){
            let html = ''
            $("#nome_procedimento_default").val(procedimentos[0].nome);
            $("#valor_procedimento_default").val(procedimentos[0].valor);
            for (let i = 1; i < procedimentos.length; i++) {
                const proc = procedimentos[i];
                html += `
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-8 form-group">
                                <label for="">Procedimento</label>
                                <input class="form-control" type="text" name="nome_procedimento[]" value="${proc.nome}" required>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="">Valor</label>
                                <input class="form-control" type="number" name="valor_procedimento[]" value="${proc.valor}" step="0.1" min="0.1" required>
                            </div>
                            <div class="col-md-1 form-group">
                                <label for=""></label>
                                <a class="btn_remove_procedimento" title="Remover Procedimento" onclick="remove_row_procedimento(this)"><span class="material-icons" style="float: left">delete</span></a>
                            </div>
                        </div>
                    </div>`;
            }
            
            $("#row_procedimento").html(html)
        }
        /*Função que remove linha do procedimento*/
        function remove_row_procedimento(context){
            $(context).parent().parent().parent().remove();
        }
        // Ao fechar modal, limpa os inputs
        $('#modalAtendimento').on('hidden.bs.modal', function (e) {
            $('#id_atendimento').val('');
            $('#profissional').val('').trigger('change');
            $('#paciente').val('').trigger('change');
            $('#data_hora_atendimento').val('');
            $('#nome_procedimento_default').val('');
            $('#valor_procedimento_default').val('');
            $('#row_procedimento').html('');

        })
        
    </script>
@endsection
