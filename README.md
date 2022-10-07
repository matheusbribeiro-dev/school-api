# School API

## Requisitos:
- Docker;
- Docker compose;

## Para rodar
Basta a partir do docker compose executar nessa pasta o comando:

```shell
$ docker compose up -d
```

> Lembre-se de executar no container a instalação das dependências do Laravel:
> ```shell
> $ docker compose exec app composer install
> ```