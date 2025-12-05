<?php
$this->assign('title', 'Prestadores de Serviço');
echo $this->Html->css('index');
?>

<body>
    <div class="container">
        <header>
            <div>
            <h1 class="title">Prestadores de Serviço</h1>
            <p class="subtitle">Veja sua lista de prestadores de serviço</p>
            </div>
            <nav>
                <?php echo $this->Html->link('<i class="ph ph-download-simple"></i> Importar', array('action' => 'import'), array('class' => 'nav-link btn-import', 'escape' => false)); ?>
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
                    <input type="text" name="search" placeholder="Buscar" value="<?php echo h($search); ?>" class="search-input">
                    <?php if (!empty($search)): ?>
                        <?php echo $this->Html->link('<i class="ph ph-x"></i>', array('action' => 'index'), array('class' => 'clear-btn', 'escape' => false)); ?>
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
                            <th>Prestador</th>
                            <th>Telefone</th>
                            <th>Serviços</th>
                            <th>Valor</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($serviceProviders as $provider): ?>
                        <tr>
                            <td class="provider-info">
                                <?php if (!empty($provider['ServiceProvider']['photo'])): ?>
                                    <?php echo $this->Html->image($provider['ServiceProvider']['photo'], array('alt' => 'Foto', 'class' => 'provider-photo')); ?>
                                <?php else: ?>
                                    <span class="provider-avatar"><?php echo strtoupper(substr($provider['ServiceProvider']['first_name'], 0, 1) . substr($provider['ServiceProvider']['last_name'], 0, 1)); ?></span>
                                <?php endif; ?>
                                <div class="provider-details">
                                    <p class="provider-name"><?php echo h($provider['ServiceProvider']['first_name'] . ' ' . $provider['ServiceProvider']['last_name']); ?></p>
                                    <p class="provider-email"><?php echo h($provider['ServiceProvider']['email']); ?></p>
                                </div>
                            </td>
                            <td class="provider-phone"><?php echo h($provider['ServiceProvider']['phone']); ?></td>
                            <td class="provider-service"><?php echo h($provider['ServiceProvider']['service']); ?></td>
                            <td class="provider-price">R$ <?php echo number_format($provider['ServiceProvider']['price'], 2, ',', '.'); ?></td>
                            <td class="provider-actions">
                                <?php echo $this->Html->link('<i class="ph ph-eye"></i>', array('action' => 'view', $provider['ServiceProvider']['id']), array('class' => 'btn btn-info', 'escape' => false)); ?>
                                <?php echo $this->Html->link('<i class="ph ph-pencil-simple-line"></i>', array('action' => 'edit', $provider['ServiceProvider']['id']), array('class' => 'btn btn-warning', 'escape' => false)); ?>
                                <?php echo $this->Form->postLink('<i class="ph ph-trash"></i>', array('action' => 'delete', $provider['ServiceProvider']['id']), array('class' => 'btn btn-danger', 'confirm' => 'Tem certeza que deseja excluir?', 'escape' => false)); ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="5">
                                <div class="pagination">
                                    <?php echo $this->Paginator->counter(array('format' => 'Página {:page} de {:pages}')); ?>
                                    <div class="pagination-links">
                                        <?php
                                        echo $this->Paginator->first('<<', array('escape' => false));
                                        echo $this->Paginator->prev('Anterior', array('escape' => false), null, array('class' => 'disabled'));
                                        echo $this->Paginator->numbers(array('separator' => ''));
                                        echo $this->Paginator->next('Próximo', array('escape' => false), null, array('class' => 'disabled'));
                                        echo $this->Paginator->last('>>', array('escape' => false));
                                        ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            <?php endif; ?>
        </main>
    </div>
</body>