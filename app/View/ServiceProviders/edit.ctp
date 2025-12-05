<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Prestador de Serviço</title>
    <?php echo $this->Html->css('edit'); ?>
</head>
<body>
    <div class="container">
        <header>
            <h1>Editar Prestador de Serviço</h1>
            <nav>
                <?php echo $this->Html->link('Início', '/', array('class' => 'nav-link')); ?>
                <?php echo $this->Html->link('Voltar', array('action' => 'index'), array('class' => 'nav-link')); ?>
            </nav>
        </header>

        <main>
            <div class="form-container">
                <?php echo $this->Form->create('ServiceProvider', array('type' => 'file', 'class' => 'form')); ?>
                <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>

                <div class="form-row">
                    <?php echo $this->Form->input('first_name', array('label' => 'Nome', 'class' => 'form-control')); ?>
                    <?php echo $this->Form->input('last_name', array('label' => 'Sobrenome', 'class' => 'form-control')); ?>
                </div>

                <?php echo $this->Form->input('email', array('label' => 'E-mail', 'class' => 'form-control')); ?>
                
                <?php echo $this->Form->input('phone', array(
                    'label' => 'Telefone',
                    'id' => 'PhoneInput',
                    'placeholder' => '(__) _____-____',
                    'maxlength' => 15,
                    'class' => 'form-control'
                )); ?>

                <?php echo $this->Form->input('photo', array('type' => 'file', 'label' => 'Foto (deixe vazio para manter a atual)')); ?>

                <div class="input text">
                    <label for="ServiceProviderService">Serviço</label>
                    <div class="autocomplete-wrapper">
                        <?php echo $this->Form->input('service', array(
                            'label' => false,
                            'id' => 'ServiceProviderService',
                            'placeholder' => 'Digite ou selecione um serviço...',
                            'autocomplete' => 'off',
                            'class' => 'form-control'
                        )); ?>
                        <div id="ServiceDropdown" class="autocomplete-dropdown"></div>
                    </div>
                </div>

                <?php echo $this->Form->input('description', array('label' => 'Descrição', 'type' => 'textarea', 'class' => 'form-control')); ?>
                
                <?php echo $this->Form->input('price', array('label' => 'Preço', 'class' => 'form-control')); ?>

                <div class="form-actions">
                    <?php echo $this->Form->end('Salvar'); ?>
                </div>
            </div>
        </main>

        <footer>
            <p>&copy; <?php echo date('Y'); ?> - Sistema de Prestadores de Serviço</p>
        </footer>
    </div>

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

        // Máscara de telefone
        document.getElementById('PhoneInput').addEventListener('input', function(e) {
            var value = e.target.value.replace(/\D/g, '');
            
            if (value.length > 11) {
                value = value.substring(0, 11);
            }
            
            if (value.length > 0) {
                value = '(' + value;
            }
            if (value.length > 3) {
                value = value.substring(0, 3) + ') ' + value.substring(3);
            }
            if (value.length > 10) {
                value = value.substring(0, 10) + '-' + value.substring(10);
            }
            
            e.target.value = value;
        });
    })();
    </script>
</body>
</html>