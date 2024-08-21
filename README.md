# PHP Performance Tests

Este repositório contém quatro aplicações PHP projetadas para realizar testes de desempenho utilizando o k6. Cada aplicação simula um tipo diferente de carga:

1. **CPU-bound:** Realiza cálculos intensivos na CPU.
2. **Memory-bound:** Usa grandes quantidades de memória.
3. **Storage-bound:** Realiza operações intensivas de leitura/escrita em disco.
4. **Database Query:** Executa consultas simples em um banco de dados MySQL.

## Objetivo

O objetivo deste repositório é fornecer um conjunto de testes de carga para avaliar o desempenho de diferentes tipos de operações em um ambiente PHP. Isso é útil para entender como cada tipo de operação afeta o desempenho geral do sistema e para identificar possíveis gargalos. Além disso, existem alguns benchmarks que podem ser bem úteis para comparação.

Caso queira contribuir com o benchmark, existe uma pasta contribuicao com um README.md que voce pode utilizar para subir seus benchmarks.

## Configuração no OpenShift

Para executar essas aplicações no OpenShift, siga as instruções abaixo.

### Pré-requisitos

- Um cluster OpenShift em execução
- Acesso ao console `oc`
- k6 instalado localmente para execução dos testes
- git 

Passos para instalacao de OC e K6 em um RHEL .

Para o OC, basta seguir a documentacao em https://docs.openshift.com/container-platform/4.16/cli_reference/openshift_cli/getting-started-cli.html .

Para o K6, a documentacao é esta https://k6.io/docs/get-started/installation/: 

```bash
sudo dnf install https://dl.k6.io/rpm/repo.rpm
sudo dnf install k6
```

### Passos para Implantação

#### 1. Criar o Namespace

Crie um novo namespace (projeto) para as aplicações:

```bash
oc new-project php-performance-tests
```
#### 2. Configurar o MySQL

1. **Criar o Serviço MySQL:**

   Use a imagem de contêiner MySQL disponível no OpenShift:

```bash
   oc new-app --name=mysql --docker-image=mysql:8.0 \
     -e MYSQL_ROOT_PASSWORD=password \
     -e MYSQL_DATABASE=testdb
```
#### 3. Implantar as Aplicações PHP

- Deployment via linha de comando...
```bash
oc new-app php~https://github.com/LucianoRed/php-performance-tests.git
oc expose service/php-performance-tests
```

- ... ou deployment via Console:

Use o deploy s2i com imagebuilder PHP para o repositorio https://github.com/LucianoRed/php-performance-tests.git

![image](https://github.com/user-attachments/assets/6c94ab4c-9de0-4302-8376-d8495f534097)

![image](https://github.com/user-attachments/assets/bcd61ac7-7b24-437f-bcf2-13c43271f6ce)

![image](https://github.com/user-attachments/assets/ec6264a7-db0f-4d9f-b750-b6e3f38ed615)

#### 3. Clonar o repositorio na maquina de testes

Pode ser na sua maquina local, desde que o k6 esteja instalado nela (https://k6.io/docs/get-started/installation/).
```bash
git clone https://github.com/LucianoRed/php-performance-tests/
cd php-performance-tests
```

#### 4. Carregar base

Acessar a URL de carga da base. Para obter a url:

```bash
oc get route php-performance-tests -n php-performance-tests -o jsonpath='{.spec.host}'
```
Acesse http://URL/database/insert.php. Leva alguns segundos para carregar. 

#### 5. Efetuar os testes

O ideal é que sejam feitos 3 testes e calculada a média. Os scripts foram criados para testes simples. 

```bash
export TESTHOST=http://`oc get route php-performance-tests -n php-performance-tests -o jsonpath='{.spec.host}'`
k6 run cpu-test.js --out csv=benchmarks/cpu/results1.csv
k6 run cpu-test.js --out csv=benchmarks/cpu/results2.csv
k6 run cpu-test.js --out csv=benchmarks/cpu/results3.csv
```
   
Mude o protocolo http:// para https:// se for testar usando https.

E para os testes de memoria e storage, nao esquecer de mudar o diretorio de saida.

#### 6. Visualizar os testes

Voce pode criar uma imagem de container que sugerimos ou usar qualquer outro webserver

```bash
podman build -t benchmark-server . -f visualizador/Containerfile
podman run --rm -it -p 8083:80 --name benchmark-container -v $(pwd)/benchmarks:/usr/share/nginx/html:z benchmark-server
```
E acesse em http://localhost:8083

![image](https://github.com/user-attachments/assets/2eaddb7b-6a2d-44a3-a081-6d68726947cf)


