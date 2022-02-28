<?php
    // Copyright(c) João Martiniano. All rights reserved.
    
    require_once('inc/class-db.php');
    require_once('inc/produtos.php');

    $produtos = null;
    $pagina = 1;
    $registosPagina = 10;
    $numeroRegistos = getNumeroProdutos();
    $totalPaginas = ceil($numeroRegistos / $registosPagina);

    if ($_SERVER['REQUEST_METHOD'] == 'GET')
	{
		// Verificar que o parâmetro pag é válido
		if (!empty($_GET['pag']))
		{
			if (ctype_digit($_GET['pag']))
			{
				// Armazenar o número de página numa variável
				$pagina = (int) $_GET['pag'];
			}
		}
	}

    $offset = ($pagina - 1) * $registosPagina;

    // Obter os dados dos produtos
    $produtos = getProdutos($offset, $registosPagina);    
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paginação</title>
    <meta name="author" content="João Martiniano" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"> 
    <script async src="js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Paginação em PHP</h1>

        <p class="mt-3 mb-2">Total de produtos: <?php echo $numeroRegistos; ?></p>

        <table class="table table-bordered table-sm mt-4">
            <thead>
                <th>ID</th>
                <th>Designação</th>
                <th>Preço</th>
                <th>Taxa IVA</th>
            </thead>
            <tbody>
                <?php
                    if ($produtos !== null)
                    {
                        foreach ($produtos as $p)
                        { ?>
                        
                        <tr>
                            <td><?php echo $p['ID']; ?></td>
                            <td><?php echo $p['Designacao']; ?></td>
                            <td><?php echo $p['Preco']; ?> €</td>
                            <td><?php echo $p['TaxaIva']; ?></td>
                        </tr>

                        <?php }
                    }
                ?>
            </tbody>
        </table>

        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <!-- Link para item anterior -->
                <li class="page-item <?php echo ($pagina == 1) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="index.php?pag=<?php echo $pagina - 1; ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                <!-- Links para cada página -->
                <?php
                    for ($i = 1; $i <= $totalPaginas; ++$i)
                    { ?>
                        <li class="page-item <?php echo ($i === $pagina) ? 'active' : ''; ?>">
                            <a class="page-link" href="index.php?pag=<?php echo $i; ?>">
                                <?php echo $i; ?>
                            </a>
                        </li>
                    <?php }
                ?>

                <!-- Link para último item -->
                <li class="page-item <?php echo ($pagina == $totalPaginas) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="index.php?pag=<?php echo $pagina + 1; ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>        
    </div>
</body>
</html>