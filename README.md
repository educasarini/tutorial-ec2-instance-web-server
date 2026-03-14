# ☁️ AWS Web Architecture: EC2 & RDS Integration

Este repositório contém a entrega da atividade ponderada de **Elaboração de uma Aplicação Integrada com Banco de Dados**. O projeto consiste em uma aplicação web funcional de Gerenciamento de Inventário, implantada em uma arquitetura de nuvem (AWS) utilizando um servidor de aplicação e um banco de dados relacional gerenciado.

🎥 **[CLIQUE AQUI PARA ASSISTIR AO VÍDEO DE DEMONSTRAÇÃO](COLOQUE_SEU_LINK_DO_YOUTUBE_AQUI)**

---

## 🏗️ Arquitetura da Solução

O projeto adota uma arquitetura clássica de duas camadas (Client-Server), separando a camada de aplicação da camada de dados para garantir maior segurança, escalabilidade e facilidade de manutenção.

* **Camada de Aplicação (Web Server):** Instância Amazon EC2 rodando Amazon Linux 2023. O servidor Apache (`httpd`) atua como servidor de páginas, processando a lógica de negócios e as requisições HTTP através do PHP 8.
* **Camada de Dados (Database):** Instância Amazon RDS rodando MySQL. Isolada em uma Subnet e acessível apenas pela instância EC2 via Security Groups (Porta 3306).
* **Camada de Apresentação (Frontend):** Interface de usuário renderizada via navegadores web, construída com HTML5 e CSS3 (Bootstrap 5) para um layout responsivo e acessível.

---

## 🛠️ Tecnologias Utilizadas e Atendimento aos Requisitos

| Requisito da Atividade | Implementação no Projeto |
| :--- | :--- |
| **Arquitetura da Web** | Modelo de requisição/resposta via HTTP; Deploy em nuvem (AWS). |
| **Servidores de pág. e app** | Apache e PHP-FPM rodando na instância EC2. |
| **Navegadores e Layout** | Interface renderizada em browser com semântica HTML e estilização via CSS (Bootstrap). |
| **Criação de Páginas HTML/CSS** | Arquivo `index.php` contendo a estrutura da interface do usuário. |
| **Integração com Banco de Dados** | Conexão segura via extensão `mysqli` do PHP comunicando-se com o Endpoint do AWS RDS. |

---

## 🗄️ Estrutura do Banco de Dados e SQL

Para atender aos requisitos de elaboração do banco de dados (no mínimo 4 campos e 3 tipos de dados distintos) e demonstrar proficiência em queries, foram implementados comandos de **SQL Básico** e **SQL Avançado**.

### SQL Básico (DDL e DML)
Criação da tabela `produtos` contendo 5 campos e 4 tipos de dados (`INT`, `VARCHAR`, `DECIMAL`, `TIMESTAMP`):

```sql
CREATE DATABASE IF NOT EXISTS inventario;
USE inventario;

CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    quantidade INT NOT NULL,
    preco DECIMAL(10, 2) NOT NULL,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

As operações de _**Create** (INSERT)_ e _**List**(SELECT)_ são realizadas dinamicamente pelo código PHP ao interagir com a interface web

### SQL Avançado (View)
Para demonstrar domínio além do CRUD básico, foi criada uma VIEW que calcula dinamicamente o valor total alocado em estoque para cada produto, processando a inteligência de negócios diretamente no banco de dados:

```sql
CREATE VIEW relatorio_financeiro AS 
SELECT 
    nome, 
    quantidade, 
    preco, 
    (quantidade * preco) AS valor_total_estoque 
FROM produtos;
```

---

## ⚙️ Deploy e Execução

O processo de implantação foi realizado seguindo boas práticas de versionamento:

1. Provisionamento da infraestrutura via console AWS (EC2 e RDS).
2. Configuração de pacotes via SSH (``dnf install httpd php php-mysqli mariadb105 git``).
3. Deploy da aplicação realizando o ``git clone`` deste repositório diretamente para o diretório de publicação do Apache (``/var/www/html/``).

---

## 📂 Estrutura do Repositório

- ``index.php``: Contém a lógica de conexão PDO/MySQLi, estruturação HTML, estilização CSS e roteamento do formulário.

- ``README.md``: Documentação arquitetural e técnica do projeto.