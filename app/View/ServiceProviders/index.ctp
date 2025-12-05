<h1>Prestadores de Serviço</h1>

<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Email</th>
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
            <td><?php echo h($provider['ServiceProvider']['email']); ?></td>
            <td><?php echo h($provider['ServiceProvider']['phone']); ?></td>
            <td><?php echo h($provider['Service']['name']); ?></td>
            <td>R$ <?php echo number_format($provider['ServiceProvider']['price'], 2, ',', '.'); ?></td>
            <td>
                <?php echo $this->Html->link('Ver', array('action' => 'view', $provider['ServiceProvider']['id'])); ?>
                <?php echo $this->Html->link('Editar', array('action' => 'edit', $provider['ServiceProvider']['id'])); ?>
                <?php echo $this->Form->postLink('Excluir', array('action' => 'delete', $provider['ServiceProvider']['id']), array('confirm' => 'Tem certeza?')); ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php echo $this->Html->link('Novo Prestador', array('action' => 'create')); ?>