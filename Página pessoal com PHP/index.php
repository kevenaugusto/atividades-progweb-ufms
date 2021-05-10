<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Keven Augusto - Perfil</title>
  <link rel="stylesheet" href="estilos.css">
</head>

<body>
  <div class="conteudo">
    <div class="foto"><img src="foto.png" alt=""></div>
    <div class="apresentacao">
      <span class="nome">Keven Augusto Queiroz Bezerra</span>
      <span class="curso">Engenharia de Computação (bacharel)</span>
      <span class="email">kevenbezerra@gmail.com</span>
    </div>
  </div>
  <footer>
    <?php 
      $data = new DateTime();
      $data->setTimezone(new DateTimeZone('America/Campo_Grande'));
      
      echo "Página gerada em " . $data->format('d/m/Y') . " às " . $data->format('H:i:s');
    ?>
  </footer>
</body>

</html>