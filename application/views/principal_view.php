<!DOCTYPE html>
<html>

<head>
    <title>Lista de Atividades</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        h1 {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px 0;
            margin: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button[type="submit"] {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        a {
            text-decoration: none;
            color: #333;
            margin-right: 10px;
        }

        /* Adicione esta classe ao container do formulário */
        .form-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
            /* Mude para 'flex-start' para alinhar à esquerda */
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }


        /* Estilo para os inputs */
        .form-container label,
        .form-container select {
            width: calc(50% - 10px);
            /* 50% do espaço com uma pequena margem */
            margin-bottom: 10px;
        }

        /* Estilo para o botão */
        .form-container button {
            width: 100%;
        }

        .form-container {
            display: flex;
            /* Use o flexbox para alinhar os elementos lado a lado */
            justify-content: space-between;
            /* Distribui o espaço entre os elementos */
            align-items: center;
            /* Alinha os elementos verticalmente no centro */
            max-width: 600px;
            /* Defina a largura máxima do formulário */
            margin: 0 auto;
            /* Centralize o formulário na página */
        }

        .form-group {
            flex-basis: 100%;
            /* Ocupa 100% da largura disponível */
            margin-bottom: 10px;
        }


        .input-register {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .button-register {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
        }
    </style>
</head>

<body>
    <h1>Lista de Atividades</h1>

    <!-- Formulário de cadastro de atividade -->
    <h2>Cadastrar Nova Atividade</h2>
    <form method="POST" action="<?= base_url('atividades/store') ?>" class="form-container">
        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <input type="text" name="descricao" id="descricao" class="input-register">
        </div>
        <div class="form-group">
            <label for="projeto">Projeto:</label>
            <select name="projeto" id="projeto">
                <?php foreach ($projetos as $projeto) : ?>
                    <option value="<?= $projeto->getId() ?>"><?= $projeto->getDescricao() ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
    </form>
    <div class="form-group">
        <button type="submit" class="button-register">Cadastrar</button>
    </div>
    </form>

    <hr>

    <!-- Campo de busca pelo ID da atividade -->
    <form method="GET" action="<?= base_url('principal/search') ?>">
        <label for="id">Buscar por ID:</label>
        <input type="text" name="id" id="id">
        <button type="submit">Buscar</button>
    </form>

    <!-- Tabela de atividades -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Descrição</th>
                <th>Projeto</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($atividades as $atividade) : ?>
                <tr>
                    <td><?= $atividade->getId() ?></td>
                    <td><?= $atividade->getDescricao() ?></td>
                    <td><?= $atividade->getIdProjeto()->getDescricao() ?></td>
                    <td>
                        <!-- Link para editar a atividade -->
                        <a href="<?= base_url('atividades/edit/' . $atividade->getId()) ?>">Editar</a>
                        <!-- Link para excluir a atividade -->
                        <a href="<?= base_url('atividades/destroy/' . $atividade->getId()) ?>">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


</body>

</html>