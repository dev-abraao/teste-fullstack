<?php
$this->assign('title', 'Prestadores de Serviço');
echo $this->Html->css('index');
?>

<body>
    <div class="container">
        <header>
            <h1>Prestadores de Serviço</h1>
            <nav>
                <?php echo $this->Html->link('Início', '/', array('class' => 'nav-link')); ?>
                <?php echo $this->Html->link('<i class="ph ph-download-simple"></i> Importar CSV', array('action' => 'import'), array('class' => 'nav-link', 'escape' => false)); ?>
                <?php echo $this->Html->link('<i class="ph ph-plus"></i> Novo Prestador', array('action' => 'create'), array('class' => 'nav-link btn-primary', 'escape' => false)); ?>
            </nav>
        </header>

        <main>
            <div class="search-box">
                <?php 
                echo $this->Form->create(null, array(
                    'type' => 'get',
                    'url' => array('controller' => 'service_providers', 'action' => 'index'),
                    'class' => 'search-form'
                ));
                ?>
                <div class="search-input-wrapper">
                    <i class="ph ph-magnifying-glass search-icon"></i>
                    <input type="text" name="search" placeholder="Buscar por nome..." value="<?php echo h($search); ?>" class="search-input">
                    <button type="submit" class="search-btn">Buscar</button>
                    <?php if (!empty($search)): ?>
                        <?php echo $this->Html->link('Limpar', array('action' => 'index'), array('class' => 'clear-btn')); ?>
                    <?php endif; ?>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>

            <?php if (!empty($search)): ?>
                <p class="search-result">Resultados para: <strong>"<?php echo h($search); ?>"</strong></p>
            <?php endif; ?>

            <?php if (empty($serviceProviders)): ?>
                <div class="no-results">
                    <p>Nenhum prestador encontrado.</p>
                </div>
            <?php else: ?>
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
                            <td>                    <?php if (!empty($serviceProvider['ServiceProvider']['photo'])): ?>
                        <div class="photo">
                            <?php echo $this->Html->image($serviceProvider['ServiceProvider']['photo'], array('alt' => 'Foto do prestador')); ?>
                        </div>
                    <?php else: ?>
                        <div class="photo photo-placeholder">
                            <span>Sem foto</span>
                        </div>
                    <?php endif; ?>
                                <?php echo h($provider['ServiceProvider']['first_name'] . ' ' . $provider['ServiceProvider']['last_name']); ?></td>
                            <td><?php echo h($provider['ServiceProvider']['phone']); ?></td>
                            <td><?php echo h($provider['ServiceProvider']['service']); ?></td>
                            <td>R$ <?php echo number_format($provider['ServiceProvider']['price'], 2, ',', '.'); ?></td>
                            <td class="actions">
                                <?php echo $this->Html->link('<i class="ph ph-eye"></i>', array('action' => 'view', $provider['ServiceProvider']['id']), array('class' => 'btn btn-info', 'escape' => false)); ?>
                                <?php echo $this->Html->link('<i class="ph ph-pencil-simple-line"></i>', array('action' => 'edit', $provider['ServiceProvider']['id']), array('class' => 'btn btn-warning', 'escape' => false)); ?>
                                <?php echo $this->Form->postLink('<i class="ph ph-trash"></i>', array('action' => 'delete', $provider['ServiceProvider']['id']), array('class' => 'btn btn-danger', 'confirm' => 'Tem certeza que deseja excluir?', 'escape' => false)); ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="pagination">
                    <?php echo $this->Paginator->counter(array('format' => 'Página {:page} de {:pages}')); ?>
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
            <?php endif; ?>
        </main>

        <footer>
            <p>&copy; <?php echo date('Y'); ?> - Sistema de Prestadores de Serviço</p>
        </footer>
    </div>
</body>