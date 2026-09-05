<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voluntários - Somos 1</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #111827;
            color: #ffffff;
        }

        .container {
            padding: 40px;
        }

        .brand {
            font-size: 28px;
            font-weight: bold;
        }

        .subtitle {
            color: #9ca3af;
            margin-bottom: 30px;
        }

        h1 {
            margin-bottom: 8px;
        }

        .description {
            color: #9ca3af;
            margin-bottom: 24px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #1f2937;
            border-radius: 12px;
            overflow: hidden;
        }

        th, td {
            padding: 16px;
            text-align: left;
            border-bottom: 1px solid #374151;
        }

        th {
            color: #9ca3af;
            font-size: 13px;
        }

        .status {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 999px;
            background: #065f46;
            font-size: 12px;
        }

        .empty {
            padding: 20px;
            color: #9ca3af;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="brand">Somos 1</div>
        <div class="subtitle">Gestão de Ministérios</div>

        <h1>Gestão de Voluntários</h1>
        <div class="description">
            Gerencie os voluntários e suas funções no ministério.
        </div>

        <?php if (! empty($volunteers)): ?>
            <table>
                <thead>
                    <tr>
                        <th>NOME</th>
                        <th>E-MAIL</th>
                        <th>TELEFONE</th>
                        <th>STATUS</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($volunteers as $volunteer): ?>
                        <tr>
                            <td><?= esc($volunteer['name']) ?></td>
                            <td><?= esc($volunteer['email']) ?></td>
                            <td><?= esc($volunteer['phone'] ?? '-') ?></td>
                            <td>
                                <span class="status">
                                    <?= $volunteer['status'] === 'ACTIVE' ? 'Ativo' : 'Inativo' ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="empty">
                Nenhum voluntário encontrado.
            </div>
        <?php endif ?>
    </div>
</body>
</html>