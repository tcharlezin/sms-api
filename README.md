## API SMS

O projeto gerencia envio e recebimento de SMS.


### Instruções para rodar o projeto

Copiar o arquivo .env.

```bash
cp .env.example .env
```

Configurar as variáveis no ENV

```bash
SMS_EMPRESA_KEY=""
```

Executar o projeto
```bash
docker-compose up -d
```

Instalar dependencias e migrations
```bash
docker-compose exec app composer install
docker-compose exec app php artisan migrate
```

--------------

## Uso da API

### POST /api/sms

Envio do SMS.

```
{
    "origem": "555199999999",
    "destino": "555199999999",
    "mensagem": "Exemplo de SMS"
}
```

Response
```
{
    "uuid": "eb550e5f-9140-43b8-bc80-1be83a0b8332",
    "origem": "555199999999",
    "destino": "555199999999",
    "mensagem": "Exemplo de SMS",
    "referencia": "1619761563"
}
```

-----------------

### POST /api/sms-receive

Recebendo payload do provider.

```
{       
    "from": "555199999999", 
    "id": "123456789",
    "id_sent": "555199999999",
    "message": "Resposta do SMS", 
    "refer": "XXXXXXX"
}
```

Response
```
[
    "OK!"
]
```

-----------------

### GET /api/sms/{uuid}

Obter informações referentes a uma mensagem

Response
```
{
    "uuid": "eb550e5f-9140-43b8-bc80-1be83a0b8332",
    "referencia": "1619761563",
    "origem": "555199999999",
    "destino": "555199999999",
    "mensagem": "Exemplo de SMS",
    "respostas": 
    [
        {
            "mensagem": "Exemplo de resposta",
            "data": "2021-09-07T18:37:59.000000Z"
        }
    ]
}
```
