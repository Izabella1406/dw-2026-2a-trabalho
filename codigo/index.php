 <?php

 require_once 'conexao.php';

 $sql = "SELECT postagem.*, usuario.nome, usuario.apelido, usuario.foto FROM postagem INNER JOIN usuario ON postagem.idusuario = usuario.idusuario ORDER BY postagem.data_hora DESC";
 
 $resultados = mysqli_query($conexao, $sql);
?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Feed</title>

</head>
<body>
   <header>
      <h1>Pop Feed</h1>
   </header>

   <main>
    <h2>Publicações</h2>

    <?php
    while ($post = mysqli_fetch_assoc($resultados)) {
    ?>

     <div class="post">
        <p><?php echo $post["texto"]; ?></p>

        <small>
           <?php echo $post["data_hora"]; ?>
        </small>

     </div>

    <?php
    }
    ?>

   </main>

</body>
</html>