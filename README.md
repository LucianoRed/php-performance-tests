# PHP Performance Tests

Este repositório contém quatro aplicações PHP projetadas para realizar testes de desempenho utilizando o k6. Cada aplicação simula um tipo diferente de carga:

1. **CPU-bound:** Realiza cálculos intensivos na CPU.
2. **Memory-bound:** Usa grandes quantidades de memória.
3. **Storage-bound:** Realiza operações intensivas de leitura/escrita em disco.
4. **Database Query:** Executa consultas simples em um banco de dados MySQL.

## Objetivo

O objetivo deste repositório é fornecer um conjunto de testes de carga para avaliar o desempenho de diferentes tipos de operações em um ambiente PHP. Isso é útil para entender como cada tipo de operação afeta o desempenho geral do sistema e para identificar possíveis gargalos.

## Configuração no OpenShift

Para executar essas aplicações no OpenShift, siga as instruções abaixo.

### Pré-requisitos

- Um cluster OpenShift em execução
- Acesso ao console `oc`
- k6 instalado localmente para execução dos testes

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

- Deployment via linha de comando:
```bash
oc new-app php~https://github.com/LucianoRed/php-performance-tests.git
oc expose service/php-performance-tests
```

- Deployment via Console:

Use o deploy s2i com imagebuilder PHP para o repositorio https://github.com/LucianoRed/php-performance-tests.git

![image](https://github.com/user-attachments/assets/6c94ab4c-9de0-4302-8376-d8495f534097)

![image](https://github.com/user-attachments/assets/bcd61ac7-7b24-437f-bcf2-13c43271f6ce)

![image](https://github.com/user-attachments/assets/ec6264a7-db0f-4d9f-b750-b6e3f38ed615)



   
