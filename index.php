<?php
$acao = "recuperarPendentes";
require "tarefa_controller.php";
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo</title>
    <link href="css/estilo.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="img/logo.png" type="image/x-icon">
    <script>
        function marcarRealizada(id) {
            location.href = "index.php?acao=marcarRealizada&id=" + id;
        }
        
        function removerTarefa(id){
            location.href = "index.php?acao=removerTarefa&id="
        }

        function editarTarefa(id, txt_tarefa) {
            //criação do from de edição
            let form = document.createElement('form');
            form.action = 'index.php?pagina=inde&acao=atualizarTarefa';
            form.method = 'post';
            form.className = 'row';
            //criação de input pra atualizar o texto
            let inputTarefa = document.createElement('input');
            inputTarefa.name = 'tarefa';
            inputTarefa.type = 'text';
            inputTarefa.value = txt_tarefa;
            inputTarefa.className = 'form-control col-sm-9';
            inputTarefa = true;

            let inputId = document.createElement('input');
            inputId.type = 'hidden';
            inputId.name = 'id';
            inputId = id;
            //criação do botão salvar
            
            let button = document.createElement('button');
            button.type = 'submit';
            button.innerHTML = 'Atualizar'
            button.classname = 'btn btn-info col-sn-2';

            //inclusão de componentes do form 
            form.appendChield(inputTarefa);
            form.appendChield(inputId);
            form.appendChield(button);

            let tarefa = document.getElementById('tarefa_' + id);
            tarefa.innerHTML = '';

            tarefa.insertBefore(form, tarefa[0]);
        }

    </script>
</head>

<body>

    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand text-white" href="#">
                <img src="img/logo.png" width="30" height="30" alt="logo">
                SuperTodo
            </a>
        </div>
    </nav>

    <div class="container app">
        <div class="row">
            <div class="col-md-3 menu">
                <ul>
                    <li class="list-group-item active"><a href="index.php">Tarefas Pendentes</a></li>
                    <li class="list-group-item"><a href="nova_tarefa.php">Nova Tarefa</a></li>
                    <li class="list-group-item"><a href="todas_tarefas.php">Todas Tarefas</a></li>
                </ul>
            </div>
            <div class="col-sm-9">
                <div class="container pagina">
                    <div class="row">
                        <div class="col">
                            <h4>Tarefas Pendentes</h4>
                            <hr />

                            <?php foreach ($tarefas as $indice => $tarefa) { ?>
                                <div class="row mb-3 d-flex align-items-center">
                                    <div class="col-sm-9" id="tarefa_<?= $tarefa->id ?>">
                                        <?= $tarefa->tarefa ?>
                                    </div>

                                    <div class="col-sm-3 d-flex justify-content-between">
                                        <i class="fa-regular fa-trash-can fa-lg text-danger" onclick="removerTarefa(<?=$tarefa->id?>)"></i>

                                        <?php if ($tarefa->status == 'pendente') { ?>
                                            <i class="fa-regular fa-pen-to-square fa-lg text-info" onclick="editarTarefa(<?= $tarefa->id?>, <?=$tarefa->tarefa?>)"></i>
                                            <i class="fa-regular fa-circle-check fa-lg text-success" onclick="marcarRealizada(<?= $tarefa->id ?>)"></i>
                                        <?php } ?>

                                    </div>
                                </div>

                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

</body>

</html>