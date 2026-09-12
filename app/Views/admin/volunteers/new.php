<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Voluntário - Somos 1</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #111827;
            color: #ffffff;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 40px;
        }

        .brand {
            font-size: 28px;
            font-weight: bold;
        }

        .subtitle {
            color: #9ca3af;
            margin-bottom: 35px;
        }

        h1 {
            margin-bottom: 8px;
        }

        .description {
            color: #9ca3af;
            margin-bottom: 30px;
        }

        .card {
            background: #1f2937;
            padding: 30px;
            border-radius: 12px;
        }

        .alert-error {
            background: #7f1d1d;
            color: #ffffff;
            padding: 14px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .field {
            margin-bottom: 22px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input,
        select {
            width: 100%;
            box-sizing: border-box;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #374151;
            background: #111827;
            color: white;
        }

        .functions {
            display: grid;
            gap: 10px;
        }

        .function-option {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: normal;
        }

        .function-option input {
            width: auto;
        }

        .actions {
            display: flex;
            gap: 12px;
            margin-top: 30px;
        }

        .button {
            display: inline-block;
            padding: 12px 18px;
            border: 0;
            border-radius: 8px;
            text-decoration: none;
            cursor: pointer;
            font-weight: bold;
        }

        .save {
            background: #2563eb;
            color: white;
        }

        .cancel {
            background: #374151;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container">

        <div class="brand">Somos 1</div>
        <div class="subtitle">Gestão de Ministérios</div>

        <h1>Novo Voluntário</h1>

        <div class="description">
            Cadastre um novo voluntário e defina seu ministério e suas funções.
        </div>

        <div class="card">

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert-error">
                    <?= esc(session()->getFlashdata('error')) ?>
                </div>
            <?php endif ?>

            <form method="post" action="<?= site_url('admin/volunteers') ?>">

                <div class="field">
                    <label for="name">Nome</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="<?= esc(old('name')) ?>"
                        required
                    >
                </div>

                <div class="field">
                    <label for="email">E-mail</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="<?= esc(old('email')) ?>"
                        required
                    >
                </div>

                <div class="field">
                    <label for="phone">Telefone</label>
                    <input
                        type="text"
                        id="phone"
                        name="phone"
                        value="<?= esc(old('phone')) ?>"
                    >
                </div>

                <div class="field">
                    <label for="birthDate">Data de nascimento</label>
                    <input
                        type="date"
                        id="birthDate"
                        name="birthDate"
                        value="<?= esc(old('birthDate')) ?>"
                    >
                </div>

                <div class="field">
                    <label for="ministryId">Ministério</label>

                    <select id="ministryId" name="ministryId">
                        <option value="">Selecione...</option>

                        <?php foreach ($ministries as $ministry): ?>
                            <option
                                value="<?= esc($ministry['id']) ?>"
                                <?= old('ministryId') === $ministry['id'] ? 'selected' : '' ?>
                            >
                                <?= esc($ministry['name']) ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="field">
                    <label>Funções</label>

                    <div class="functions">

                        <?php
                        $oldFunctions = old('functions') ?? [];
                        ?>

                        <?php foreach ($functions as $function): ?>

                            <label class="function-option">

                                <input
                                    type="checkbox"
                                    name="functions[]"
                                    value="<?= esc($function['id']) ?>"
                                    <?= in_array($function['id'], $oldFunctions, true) ? 'checked' : '' ?>
                                >

                                <?= esc($function['name']) ?>

                            </label>

                        <?php endforeach ?>

                    </div>
                </div>

                <div class="actions">

                    <button type="submit" class="button save">
                        Salvar voluntário
                    </button>

                    <a href="<?= site_url('admin/volunteers') ?>" class="button cancel">
                        Cancelar
                    </a>

                </div>

            </form>

        </div>
    </div>
</body>
</html>