<?php

 require_once "conexao.php";

 $sql = " SELECT
	u.nome AS autor,
    p.texto AS conteudo,
    COUNT(DISTINCT c.idcomentario) AS quantidade_comentarios,
    COUNT(DISTINCT c2.idusuario) AS quantidade_curtidas,
    (
		COUNT(DISTINCT c.idcomentario) + COUNT(DISTINCT c2.idusuario)
	) AS popularidade
   FROM postagem p INNER JOIN usuario u ON p.idusuario = u.idusuario
   LEFT JOIN comentario c
   ON p.idpostagem = c.idpostagem
   LEFT JOIN curtida c2
   ON p.idpostagem = c2.idpostagem
   WHERE p.idusuario <> 3
   GROUP BY
	  p.idpostagem,
     u.nome,
     p.texto
   ORDER BY popularidade DESC";  

$resultados = mysqli_query($conexao, $sql);
?> 
 
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Feed</title>
    <link rel="stylesheet" href="./style.css">

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
        <p>Autor: <?php echo $post["autor"]; ?></p>  
        <p><?php echo $post["conteudo"]; ?></p>
        <p>Comentários: <?php echo $post["quantidade_comentarios"]; ?></p>
        <p>Curtidas: <?php echo $post["quantidade_curtidas"]; ?></p>

     </div>

    <?php
    }
    ?>
   

   </main>

</body>
</html>