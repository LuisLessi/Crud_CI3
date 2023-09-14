<!DOCTYPE html>
<html>
<head>
    <title>Editar Atividade</title>
    <!-- Adicione os estilos CSS necessários aqui, se necessário -->
</head>
<style>
body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            background-color: #333;
            color: #fff;
            padding: 10px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            margin: 20px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            background-color: #333;
            color: #fff;
            padding: 10px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            margin: 20px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        button[type="submit"] {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #555;
        }
    </style>
<body>
    <h1>Editar Atividade</h1>

    <form method="POST" action="<?= base_url('atividades/update/' . $atividade->getId()) ?>">
        <label for="descricao">Descrição:</label>
        <input type="text" name="descricao" id="descricao" value="<?= $atividade->getDescricao() ?>">
        <div class="form-group">
            <label for="projeto">Projeto:</label>
            <select name="projeto" id="projeto">
                <?php foreach ($projetos as $projeto) : ?>
                    <?php
                        $selected = ($projeto->getId() == $atividade->getIdProjeto()->getId()) ? 'selected' : '';
                    ?>
                    <option value="<?= $projeto->getId() ?>" <?= $selected ?>><?= $projeto->getDescricao() ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit">Salvar</button>
    </form>
</body>
</html>
