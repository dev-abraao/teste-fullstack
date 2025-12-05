<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prestadores de Serviço</title>
    <?php echo $this->Html->css('index'); ?>
</head>
<body>
    <div class="container">
        <header>
            <h1>Prestadores de Serviço</h1>
            <nav>
                <?php echo $this->Html->link('Início', '/', array('class' => 'nav-link')); ?>
                <?php echo $this->Html->link('Novo Prestador', array('action' => 'create'), array('class' => 'nav-link btn-primary')); ?>
            </nav>
        </header>

        <main>
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>Serviço</th>
                        <th>Preço</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($serviceProviders as $provider): ?>
                    <tr>
                        <td><?php echo h($provider['ServiceProvider']['first_name'] . ' ' . $provider['ServiceProvider']['last_name']); ?></td>
                        <td><?php echo h($provider['ServiceProvider']['phone']); ?></td>
                        <td><?php echo h($provider['ServiceProvider']['service']); ?></td>
                        <td>R$ <?php echo number_format($provider['ServiceProvider']['price'], 2, ',', '.'); ?></td>
                        <td class="actions">
                            <?php echo $this->Html->link('Ver', array('action' => 'view', $provider['ServiceProvider']['id']), array('class' => 'btn btn-info')); ?>
                            <?php echo $this->Html->link('Editar', array('action' => 'edit', $provider['ServiceProvider']['id']), array('class' => 'btn btn-warning')); ?>
                            <?php echo $this->Form->postLink('Excluir', array('action' => 'delete', $provider['ServiceProvider']['id']), array('class' => 'btn btn-danger', 'confirm' => 'Tem certeza que deseja excluir?')); ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="pagination">
                <?php
                echo $this->Paginator->counter(array(
                    'format' => 'Página {:page} de {:pages}'
                ));
                ?>
                
                <div class="pagination-links">
                    <?php
                    echo $this->Paginator->first('<<', array('escape' => false));
                    echo $this->Paginator->prev('<', array('escape' => false), null, array('class' => 'disabled'));
                    echo $this->Paginator->numbers(array('separator' => ''));
                    echo $this->Paginator->next('>', array('escape' => false), null, array('class' => 'disabled'));
                    echo $this->Paginator->last('>>', array('escape' => false));
                    ?>
                </div>
            </div>
        </main>

        <footer>
            <p>&copy; <?php echo date('Y'); ?> - Sistema de Prestadores de Serviço</p>
        </footer>
    </div>
</body>
</html>