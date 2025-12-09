# Teste FullStack - Abraão Andrade

Opa! Este repositório contém a solução para o desafio técnico da vaga de fullstack. Abaixo estão as instruções para rodar o projeto.

## 📹 Vídeo de Demonstração

[Assista aqui](https://www.youtube.com/watch?v=v_0VNv89-cE)

---

## 🐳 Rodando com Docker (Recomendado)

### Pré-requisitos
- Docker Desktop instalado
- Git instalado

### Passos

1. **Clone o repositório**
```bash
git clone https://github.com/dev-abraao/teste-fullstack.git
cd teste-fullstack
```

2. **Checkout na branch develop ou release**
```bash
git checkout develop
```
ou
```bash
git checkout release
```

3. **Inicie os containers**
```bash
docker compose up --build
```

> **Nota:** Se você usa Docker versão anterior, utilize `docker-compose` ao invés de `docker compose`

4. **Acesse a aplicação**
```
http://localhost:8080
```

### O que o Docker faz automaticamente
- ✅ Cria o banco de dados `doity`
- ✅ Configura as tabelas (schema)
- ✅ Instala todas as dependências PHP
- ✅ Ajusta permissões de pastas

---

## 💻 Rodando Localmente

### Pré-requisitos
- PHP 7.4.33 (ou alguma versão compatível com CakePHP 2)
- MySQL
- Composer
- Git

> ⚠️ **Importante:** CakePHP 2 não é compatível com PHP 8+

### Passos

1. **Clone o repositório**
```bash
git clone https://github.com/dev-abraao/teste-fullstack.git
cd teste-fullstack
```
2. **Checkout na branch develop ou release**
```bash
git checkout develop
```
ou
```bash
git checkout release
```

3. **Configure o banco de dados**

Edite `app/Config/database.php`:

```php
public $default = array(
    'datasource' => 'Database/Mysql',
    'persistent' => false,
    'host'     => 'localhost',      // seu host
    'login'    => 'root',           // seu usuário
    'password' => 'seu_password',   // sua senha
    'database' => 'doity',          // nome do banco
    'prefix'   => '',
    'flags'    => array(
        PDO::MYSQL_ATTR_LOCAL_INFILE => true,  // necessário para importar CSV
    ),
    'encoding' => 'utf8',
);
```

4. **Crie o banco de dados**
```bash
mysql -u root -p
```

```sql
CREATE DATABASE doity;
EXIT;
```

5. **Instale as dependências**
```bash
composer install
```

6. **Configure permissões** (Linux/Mac)
```bash
chmod -R 777 app/Console/cake
chmod -R 777 app/tmp
chmod -R 777 app/webroot
```

7. **Execute o schema**
```bash
app/Console/cake schema create
```

Quando perguntado, digite `y` e pressione Enter para criar as tabelas.

8. **Inicie o servidor PHP**
```bash
php -S localhost:8000 -t app/webroot/
```

9. **Acesse a aplicação**
```
http://localhost:8000
```

---

## 📋 Funcionalidades

- ✅ Listar prestadores de serviço
- ✅ Criar novo prestador (com upload de foto)
- ✅ Editar prestador existente
- ✅ Deletar prestador
- ✅ Visualizar detalhes em modal
- ✅ Buscar prestadores por nome, email ou serviço
- ✅ Importar prestadores via CSV
- ✅ Validações de formulário

---

## 🛠 Stack Utilizado

- **Backend:** CakePHP 2.10.24
- **Frontend:** HTML5, CSS3, JavaScript (jQuery)
- **Banco de Dados:** MySQL 8.4.3
- **Containerização:** Docker & Docker Compose
- **Servidor:** Apache 2.4.62

---

