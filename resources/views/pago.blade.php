<!DOCTYPE html>
       

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel Mercado pago test</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

  
</head>

<body class="antialiased">

    <h1>Prueba integracion Checkout pro Mercado pago v1</h1>

    <div class="cho-container">

    </div>
</body>

<script src="https://sdk.mercadopago.com/js/v2"></script>

<script>
    // Agrega credenciales de SDK
    const mp = new MercadoPago("{{$key}}", {
      locale: "es-AR",
    });
  
    // Inicializa el checkout
    mp.checkout({
      preference: {
        id: "{{$preference->id}}",
      },
      render: {
        container: ".cho-container", // Indica el nombre de la clase donde se mostrará el botón de pago
        label: "Pagar", // Cambia el texto del botón de pago (opcional)
      },
    });
  </script>
</html>
