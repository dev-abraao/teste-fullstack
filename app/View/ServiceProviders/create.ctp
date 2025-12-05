<h1>Novo Prestador de Serviço</h1>

<style>
.autocomplete-wrapper {
    position: relative;
}
.autocomplete-dropdown {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: white;
    border: 1px solid #ccc;
    border-top: none;
    max-height: 200px;
    overflow-y: auto;
    display: none;
    z-index: 1000;
}
.autocomplete-dropdown.show {
    display: block;
}
.autocomplete-item {
    padding: 10px;
    cursor: pointer;
}
.autocomplete-item:hover {
    background: #f0f0f0;
}
</style>

<?php
echo $this->Form->create('ServiceProvider', array('type' => 'file'));

echo $this->Form->input('first_name', array('label' => 'Nome'));
echo $this->Form->input('last_name', array('label' => 'Sobrenome'));
echo $this->Form->input('email', array('label' => 'E-mail'));
echo $this->Form->input('photo', array('type' => 'file', 'label' => 'Foto'));
echo $this->Form->input('phone', array('label' => 'Telefone'));
?>

<div class="input text">
    <label for="ServiceProviderService">Serviço</label>
    <div class="autocomplete-wrapper">
        <?php echo $this->Form->input('service', array(
            'label' => false,
            'id' => 'ServiceProviderService',
            'placeholder' => 'Digite ou selecione um serviço...',
            'autocomplete' => 'off'
        )); ?>
        <div id="ServiceDropdown" class="autocomplete-dropdown"></div>
    </div>
</div>

<?php
echo $this->Form->input('description', array('label' => 'Descrição', 'type' => 'textarea'));
echo $this->Form->input('price', array('label' => 'Preço'));
echo $this->Form->end('Cadastrar');
?>

<script>
(function() {
    var suggestions = <?php echo json_encode(array_values($serviceSuggestions)); ?>;
    var input = document.getElementById('ServiceProviderService');
    var dropdown = document.getElementById('ServiceDropdown');

    function renderDropdown(filter) {
        dropdown.innerHTML = '';
        var hasResults = false;

        suggestions.forEach(function(name) {
            if (name.toLowerCase().indexOf(filter.toLowerCase()) !== -1) {
                hasResults = true;
                var item = document.createElement('div');
                item.className = 'autocomplete-item';
                item.textContent = name;
                item.addEventListener('click', function() {
                    input.value = this.textContent;
                    dropdown.classList.remove('show');
                });
                dropdown.appendChild(item);
            }
        });

        if (hasResults && filter.length > 0) {
            dropdown.classList.add('show');
        } else {
            dropdown.classList.remove('show');
        }
    }

    input.addEventListener('focus', function() {
        if (this.value.length > 0) {
            renderDropdown(this.value);
        }
    });

    input.addEventListener('input', function() {
        renderDropdown(this.value);
    });

    document.addEventListener('click', function(e) {
        if (!e.target.closest('.autocomplete-wrapper')) {
            dropdown.classList.remove('show');
        }
    });
})();
</script>