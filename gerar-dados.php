<?php
    // Copyright(c) João Martiniano. All rights reserved.

    require_once('inc/class-db.php');

    $db = Db::getConnection();

    echo "<h1>Paginação PHP::Gerador de Dados</h1>";

    echo "<p>A inserir dados</p>";

    for ($i = 1; $i <= 135; ++$i)
    {
        try
        {

            $stmt = $db->prepare('INSERT INTO produtos (Designacao, Preco, TaxaIva) VALUES (:Designacao, :Preco, :TaxaIva)');
            $stmt->bindValue(':Designacao', 'Produto ' . $i, PDO::PARAM_STR);
            $stmt->bindValue(':Preco', rand(1, 9999), PDO::PARAM_STR);
            $stmt->bindValue(':TaxaIva', (rand(0, 2) >= 1) ? 0.23 : 0.06, PDO::PARAM_STR);

            if ($stmt->execute() === true)
            {
                echo "Inserido registo {$i} (ID = {$db->lastInsertId()})<br>";
            }
        }
        catch (PDOException $e)
        {
            echo "<p>Erro ao inserir o registo {$i}</p>";
            die();
        }
    }

    echo "<p>Fim<br>Inseridos {$i} registos</p>";