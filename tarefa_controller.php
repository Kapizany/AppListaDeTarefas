<?php

    require "../tarefaModel.php"; //dou require na pasta de arquivos publicos, assim o contexto muda
    require "../tarefaService.php";
    require "../conexao.php";

    $acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

    if ( $acao =='inserir') {

        $tarefa = new Tarefa();
        $tarefa->__set('tarefa', $_POST['tarefa']);

        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefaService->inserir();

        header('Location: nova_tarefa.php?inclusao=1');
    } else if ($acao =='recuperar'){
        $tarefa = new Tarefa();
        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefas = $tarefaService->recuperar();
        

    } else if ($acao == 'atualizar'){

        $tarefa = new Tarefa();
        $tarefa->__set('id',$_POST['id']);
        $tarefa->__set('tarefa',$_POST['tarefa']);
        $conexao = new Conexao();
        $tarefaService = new TarefaService($conexao, $tarefa);
        $resposta = $tarefaService->atualizar();
        $atualizacao = 0;
        if ($resposta){
            $atualizacao = 1;
        }

        header('Location: todas_tarefas.php?atualizacao='.$atualizacao);

    } else if ($acao == 'remover'){
        $tarefa = new Tarefa();
        $tarefa->__set('id',$_GET['id']);

        $conexao = new Conexao();
        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefaService->remover();

        header('Location: todas_tarefas.php');
    } else if ($acao == 'marcarRealizada'){

        $tarefa = new Tarefa();
        $tarefa->__set('id',$_GET['id']);
        $tarefa->__set('id_status', 2);

        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefaService->marcarRealizada();

        header('Location: todas_tarefas.php');
    }
    else if ($acao == 'restaurar'){

        $tarefa = new Tarefa();
        $tarefa->__set('id',$_GET['id']);
        $tarefa->__set('id_status', 1);

        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefaService->restaurar();

        header('Location: todas_tarefas.php');
    } else if ( $acao =='pendentes') {

        $tarefa = new Tarefa();
        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefas = $tarefaService->pendentes();
        
    }



?>