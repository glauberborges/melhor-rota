Criação de Clientes

> Disponibilizar projeto junto com dump SQL no github em modo público;
> Enviar link do repositório para fernando.sartori@uello.com.br;thiago@uello.com.br;marcelo.cerqueira@uello.com.br


Requisitos negócio:

- [ ] Criar estrutura banco de dados:    
- [X] Importar um arquivo CSV de cliente(s);
- [X] Parsear endereço (logradouro, número, complemento, bairro, cep, cidade);
- [X] Buscar GeoLocalização (GeoCoding) utilizando API do Google;
- [ ] Salvar em Banco de dados;
- [ ] Exibir em um grid os dados importados no BD;
- [ ] Exportar dados do Grid em csv;
- [ ] Gerar uma sequência lógica de entregas entre os endereços importados do csv:
    > Utilizar o endereço Avenida Dr. Gastão Vidigal, 1132 - Vila Leopoldina - 05314-010 como ponto inicial;

CustomerstModel -m

Requisitos Técnicos:

- controle de versionamento (GIT)
- PHP 7;
- Utilizar Composer para libs externas;
- Framework;
- Mysql;
- Front Bootstrap;

O que se espera: 

- Utilização de Design Patterns (https://www.php-fig.org/psr/)
- Desenvolvimento da Lógica para leitura do CSV;
- Validação e cleanup dos dados(Parse endereço);
- Buscar geocoding;
- Estruturação da tabela;
- Salvar dados BD;

Diferenciais:

- Docker;
- Testes Unitários;

Dados do arquivo:
nome;email;datanasc;cpf;endereco;cep
thiago;thiago@uello.com.br;11/11/1911;123.456.789-01;R Almirante Brasil, 685 - Mooca - São Paulo;03162-010
Marcelo Cerqueira;marcelo.cerqueira@uello.com.br;11/07/1952;987.654.321-09;Rua Itajaí, 125 Ap 1234 - Mooca - São Paulo;03162-060
André;andre@uello.com.br;11/05/1988;987.654.321-09;Rua José Monteiro, 303 - Brás - São Paulo;03052-010
Fernando Sartori;fernando.sartori@uello.com.br;11/03/1975;987.654.321-09;Rua Ipanema, 686 Conj 1 - Brás - São Paulo;03164-200
