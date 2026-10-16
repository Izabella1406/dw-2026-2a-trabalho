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
   <header class="cabecalho">
    <div class="logo">
        <span class="icone-logo">🧭</span>

        <div>
            <h1>POP FEED</h1>
            <p>Descubra publicações populares da nossa rede!</p>
        </div>
    </div>
</header>
   <main>
    <h2>Publicações</h2>

    <?php
    while ($post = mysqli_fetch_assoc($resultados)) {
    ?>

    
<div class="post">

    <div class="autor">
        <div class="avatar">👤</div>

        <h3>
            <?php echo $post["autor"]; ?>
        </h3>
    </div>

    <p class="conteudo">
        <?php echo $post["conteudo"]; ?>
    </p>

    <div class="interacoes">

        <span class="curtidas">
            ♥
            <?php echo $post["quantidade_curtidas"]; ?>
            curtidas
        </span>

        <span class="comentarios">
            💬
            <?php echo $post["quantidade_comentarios"]; ?>
            comentários
        </span>

    </div>

</div>


    <?php
    }
    ?>
   

   </main>

</body>
</html>