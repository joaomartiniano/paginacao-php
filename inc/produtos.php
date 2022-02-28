<?php
    // Copyright(c) João Martiniano. All rights reserved.
    
    /*
        Obtém o número de registos (produtos) na base de dados.
        
        Retorna:
            o número de registos ou null caso tenha ocorrido um erro
    */
    function getNumeroProdutos()
    {

        $db = Db::getConnection();

        if ($db === null)
        {
            return null;
        }

        // Declarar e inicializar a variável que irá conter os dados
        $dados = null;

        try
        {
        
            $stmt = $db->prepare("SELECT COUNT(*) AS num FROM produtos");

            // Executar a query e verificar que não retornou false
            if (($stmt->execute() === true) && ($stmt->rowCount() == 1))
            {
                $registo = $stmt->fetch(PDO::FETCH_ASSOC);
                $dados = (int) $registo['num'];
            }
        }
        catch (PDOException $e)
        {
            $dados = null;
        }
    
        return $dados;
    }

    /*
        Obtém os produtos da base de dados.
        
        Retorna:
            os produtos ou null caso tenha ocorrido um erro ou não existam produtos a retornar
    */
    function getProdutos($offset, $registosPagina)
    {
        $db = Db::getConnection();

        if ($db === null)
        {
            return null;
        }

        // Declarar e inicializar a variável que irá conter os dados
        $dados = null;

        try
        {    
            $stmt = $db->prepare("SELECT * FROM produtos LIMIT :offset, :registos_pagina");
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->bindValue(':registos_pagina', $registosPagina, PDO::PARAM_INT);

            // Executar a query e verificar que não retornou false
            if ($stmt->execute())
            {
                $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        catch (PDOException $e)
        {
            $dados = null;
        }
    
        return $dados;
    }