<h1>Detalhes do Prestador</h1>

<p><strong>Nome:</strong> <?php echo h($serviceProvider['ServiceProvider']['first_name'] . ' ' . $serviceProvider['ServiceProvider']['last_name']); ?></p>
<p><strong>Email:</strong> <?php echo h($serviceProvider['ServiceProvider']['email']); ?></p>
<p><strong>Telefone:</strong> <?php echo h($serviceProvider['ServiceProvider']['phone']); ?></p>
<p><strong>Serviço:</strong> <?php echo h($serviceProvider['ServiceProvider']['service']); ?></p>
<p><strong>Preço:</strong> R$ <?php echo number_format($serviceProvider['ServiceProvider']['price'], 2, ',', '.'); ?></p>

<?php if (!empty($serviceProvider['ServiceProvider']['photo'])): ?>
    <p><strong>Foto:</strong></p>
    <?php echo $this->Html->image($serviceProvider['ServiceProvider']['photo'], array('width' => 200)); ?>
<?php endif; ?>

<p>
    <?php echo $this->Html->link('Voltar', array('action' => 'index')); ?> |
    <?php echo $this->Html->link('Editar', array('action' => 'edit', $serviceProvider['ServiceProvider']['id'])); ?>
</p>