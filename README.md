# Sistema de Cadastro de Roupas

Este é um **sistema de cadastro** desenvolvido para uma loja de roupas, permitindo que os usuários cadastrem, visualizem, editem, pesquisem e excluam informações sobre os produtos no estoque. O sistema foi projetado com funcionalidades intuitivas e uma interface amigável.

## Funcionalidades

- **Cadastro de Roupas:** Adicione novas roupas com **ID (auto incremento)**, **descrição**, **quantidade** e **preço**.
- **Visualização de Produtos:** Modal interativo para visualização rápida das informações de cada produto.
- **Edição de Produtos:** Atualize as informações de uma roupa já cadastrada diretamente na plataforma.
- **Pesquisa de Produtos:** Pesquise por nome da roupa para facilitar a localização e gerenciamento do estoque.
- **Deleção de Produtos:** A exclusão de produtos não remove as informações do banco de dados, mas altera a situação do item para **'inativo'** (situação 0), mantendo o histórico de produtos deletados.

## Tecnologias Utilizadas

- **Frontend:**  
  - **HTML**  
  - **CSS**  
  - **Bootstrap**  
  - **JavaScript**

- **Backend:**  
  - **PHP**  
  - **Banco de Dados:** **MySQL**

## Como Usar

1. **Configuração do Banco de Dados:**
   - Este sistema depende de uma conexão com um banco de dados MySQL.  
   - Preencha as informações de conexão no arquivo **`conexao.php`**:  
     - **servidor:** Endereço do servidor MySQL  
     - **usuario:** Nome de usuário do banco  
     - **senha:** Senha do banco  
     - **nome do banco:** Nome do banco de dados utilizado.

2. **Executando o Sistema:**
   - Para rodar o sistema, é necessário um servidor web com PHP instalado.
   - O sistema é acessado via navegador após o upload dos arquivos para o servidor.

3. **Interação com a Interface:**
   - O sistema oferece uma interface intuitiva onde o usuário pode:
     - Cadastrar novas roupas.
     - Visualizar, editar e excluir roupas já cadastradas.
     - Pesquisar rapidamente pelo nome da roupa.


