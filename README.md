## 📋 Sistema de Cadastro de Clientes para Análise de Financiamento

Este projeto é um sistema web desenvolvido em PHP com HTML, CSS e jQuery, com backend em SQL Server. Ele permite o cadastro detalhado de clientes com dados pessoais, financeiros e bancários, voltado para análises de crédito e financiamento.

### 🚀 Funcionalidades

- Cadastro completo de clientes
- Máscaras de CPF, CNPJ e campos numéricos
- Validação básica no front-end com jQuery
- Armazenamento em banco de dados SQL Server
- Fallback de valores para campos não preenchidos
- Geração de relatórios em PDF

### 🛠️ Tecnologias Utilizadas

- PHP
- HTML/CSS
- JavaScript (jQuery)
- SQL Server
- Bootstrap (opcional)
- Dompdf (para gerar PDF)

### 🛆 Estrutura

- `forms.php`: formulário principal com os campos de cadastro e lógica de envio para o banco de dados.
- `gerador.php`: geração de relatórios em PDF com os dados dos clientes.

### 🧰 Pré-requisitos

- Servidor com suporte a PHP (Apache, XAMPP, IIS etc.)
- Conexão com SQL Server habilitada (via `sqlsrv`)
- Biblioteca `dompdf` instalada via Composer
- Banco de dados com tabela apropriada para os dados de cliente

### 🔧 Instalação

1. Clone o repositório:
   ```bash
   git clone https://github.com/seu-usuario/seu-repo.git
   ```

2. Configure a conexão com o banco de dados nos arquivos `forms.php` e `gerador.php`.

3. Instale as dependências do projeto:
   ```bash
   composer install
   ```

4. Suba em um servidor local ou remoto com suporte a PHP + SQL Server.

5. Acesse via navegador:
   ```
   http://localhost/seu-caminho/forms.php
   ```

### 🥪 Testando

- Preencha o formulário com dados fictícios
- Verifique no banco de dados se os dados foram inseridos corretamente
- Gere relatórios em PDF acessando `gerador.php`

### 📌 Observações

- Certifique-se de que a extensão `sqlsrv` está habilitada no PHP
- A biblioteca `dompdf` é usada para a exportação em PDF
- Caso deseje incluir novos campos, atualize tanto os arquivos `.php` quanto a estrutura da tabela no banco de dados

### 📄 Licença

Este projeto está sob a licença MIT. Veja o arquivo `LICENSE` para mais detalhes.

