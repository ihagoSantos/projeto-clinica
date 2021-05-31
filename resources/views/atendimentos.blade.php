@extends('layouts.app')

@section('css')
    <style>
        #btn-novo-atendimento{
            float: right;
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
                <table class="table table-stripped table-hover table-responsive" id="table_atendimentos">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Paciente</th>
                            <th>Profissional</th>
                            <th>Data</th>
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
                    <form>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Profissional</label>
                                <select class="" name="profissional" id="profissional" style="width: 100%">
                                    <option value="">ihago</option>
                                    <option value="">ihago</option>
                                    <option value="">ihago</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="">Paciente</label>
                                <select class="form-control" name="paciente" id="paciente" style="width: 100%">
                                    <option value="">ihago</option>
                                    <option value="">ihago</option>
                                    <option value="">ihago</option>
                                </select>
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
    </div>    

    

@endsection
@section('javascript')
    <script>
        let table = $("#table_atendimentos").DataTable();
        $("#profissional").select2({
            dropdownParent: $("#modalAtendimento")
        });
        $("#paciente").select2({
            dropdownParent: $("#modalAtendimento")
        });
    </script>
@endsection
