function editar(id, tarefa_antiga){
    //criar form de edição
    let form = document.createElement("form")
    form.action="tarefa_controller.php?acao=atualizar"
    form.method="post"
    form.className = "row"

    //Criar input para entrada de texto
    let inputTarefa = document.createElement("input")
    inputTarefa.type = "text"
    inputTarefa.name = "tarefa"
    inputTarefa.className = "col-9 form-control"
    inputTarefa.value = tarefa_antiga

    //Input para enviar o id da tarefa ao backend
    let inputId = document.createElement("input")
    inputId.type = "hidden"
    inputId.name = "id"
    inputId.value = id 


    //Criar button para envio do form
    let button = document.createElement("button")
    button.type = "submit"
    button.className = "col-3 btn btn-info"
    button.innerHTML = "Atualizar"

    //incluir tarefa no form
    form.appendChild(inputTarefa)

    //incluir inputId no form
    form.appendChild(inputId)

    //incluir button no form
    form.appendChild(button)

    //selecionando a tarefa
    tarefa = document.getElementById('tarefa_'+id)
    
    //limpando o conteudo e inserindo o form
    tarefa.innerHTML = ''
    tarefa.appendChild(form)


}

function remover(id){
    location.href = "todas_tarefas.php?acao=remover&id=" + id
}

function marcarRealizada(id){
    location.href = "todas_tarefas.php?acao=marcarRealizada&id=" + id
}

function restaurar(id){
    location.href = "todas_tarefas.php?acao=restaurar&id=" + id
}