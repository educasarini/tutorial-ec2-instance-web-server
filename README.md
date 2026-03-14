# AWS Web App: EC2 + RDS Integration

Projeto prático de elaboração de uma aplicação web (HTML/CSS/PHP) integrada a um banco de dados relacional na nuvem.

## Arquitetura
* **Camada de Aplicação:** Servidor Apache rodando PHP em uma instância Amazon EC2.
* **Camada de Dados:** Amazon RDS executando MySQL.
* **Interface:** HTML5 e CSS3 (Bootstrap) para layout responsivo.

## Estrutura do Banco de Dados (SQL Utilizado)
A tabela `produtos` foi criada contendo 5 campos e 4 tipos de dados distintos (INT, VARCHAR, DECIMAL, TIMESTAMP):
\`\`\`sql
CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    quantidade INT NOT NULL,
    preco DECIMAL(10, 2) NOT NULL,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
\`\`\`

## Funcionalidades
* **Create:** Formulário via POST para inserção de dados via PHP PDO/MySQLi.
* **List:** Consulta estruturada (SELECT) apresentada em tabela HTML formatada.

## Vídeo de Demonstração
[Insira aqui o link do YouTube para o seu vídeo]