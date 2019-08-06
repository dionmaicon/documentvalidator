# Document Validator
Microservice Lumen + Vue.js + Vue-Crudgen + MongoDB + Docker

## Backend 
Primeiro faça o download do repositório, descompacte e entre na pasta do projeto.
No diretorio da aplicação, criar um folder chamado "db" e dar permissão de leitura e escrita.

```
cd documentvalidator
mkdir db
chmod -R 777 db

```
Dar permissão de escrita para os scripts:

``` bash
chmod +x build.sh
chmod +x run.sh
chmod +x start.sh
```
Rodar em sequência:

```bash
./build.sh
./run.sh
./start.sh
```

Após, startar o projeto o backend já está rodando em dois dockers. O Backend utiliza MongoDB (validator_mongodb) e Apache2, PHP 7.2 (validator_backend). Lumen está configurado com Doctrine ODM.

## Frontend 
Instalar o Node.js e Npm no host.
Entar no diretorio do frontend e rodar o webpack.

```bash
cd frontend/docvalidatorpwa
npm install
npm run serve
```
Acessar no browser o endereço informado pelo webpack server.

Para fazer o build.

```bash
npm run build
```
Para visualizar antes de publicar. Instalar o serve "npm install --save-dev serve" ou similar (vue/cli tem um built-in também).

```
serve /dist
```

## License
[MIT](https://choosealicense.com/licenses/mit/)
