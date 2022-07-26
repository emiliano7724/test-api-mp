
# API Pagos

Api para gestión de pagos a traves de distintos servicios de pago electrónico.

## Environment Variables

Variables de entorno.

## Mercado Pago


`API_PAY=https://api.mercadopago.com/v1/payments/`

`API_PREFERENCE=https://api.mercadopago.com/checkout/preferences/`


## Servicios de Pago. Documentacion

 - [Mercado Pago Chekout Pro](https://www.mercadopago.com.ar/developers/es)
 


## API Reference

#### Preparar el pago. 
##### Retorna la orden de pago para ser abonada. Contiene la información necesaria para realizar el pago. 


```http
  POST /api/prepare/pay
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `id_cliente_api_pago` | `int` | **Required**. Id de Cliente con acceso a la API |
| `name_plataforma_pago` | `string` | **Required**. Nombre Definido del servicio de pago |
| `items` | `array` | **Required**. Array de datos del Item |
| `comprador` | `array` |  Array de datos del Item |




## License


[![MIT License](https://img.shields.io/apm/l/atomic-design-ui.svg?)](https://github.com/tterb/atomic-design-ui/blob/master/LICENSEs)


## Usado por

Esta api es usada por las siguiente companias.

- Basa
- Bae


## SofreDigital

API pagos.


## Authors

- [@emarquez](https://github.com/emiliano7724)

