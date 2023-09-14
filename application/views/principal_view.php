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
    </style>
</head>

<body>
    <h1>Lista de Atividades</h1>

    <!-- Formulário de cadastro de atividade -->
    <h2>Cadastrar Nova Atividade</h2>
    <form method="POST" action="<?= base_url('atividades/store') ?>">
        <label for="descricao">Descrição:</label>
        <input type="text" name="descricao" id="descricao">
        <button type="submit">Cadastrar</button>
    </form>

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
                <td>a</td>
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