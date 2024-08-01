<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tarefas</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Lista de Tarefas</h1>
    <a href="index.php?action=create_task">Criar novo tarefa</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Task</th>
                <th>Prazo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tasks as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['id'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($user['task'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($user['prazo'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>
                        <a href="index.php?action=read_task&id=<?php echo $user['id']; ?>">Ver</a>
                        <a href="index.php?action=update_task&id=<?php echo $user['id']; ?>">Editar</a>
                        <a href="index.php?action=delete_task&id=<?php echo $user['id']; ?>">Apagar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>