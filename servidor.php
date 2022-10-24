<?php
class Servidor {
    
    function conexao(){
         
        try
        {
            //Conectar
            $ligacao = new PDO("mysql:dbname=eleicao; host=localhost", "root", "");
            $ligacao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            //Em caso de pesquisas, via procedures
            //$pesq = "";
            //$sql = "CALL Nome_da_procedure()";
        
            //Em caso de querys
            $sql = "SELECT * FROM votacoes WHERE nome= :nome_param";
        
            $resultados = $ligacao->prepare($sql);
        
            //Definição de parâmetros
            $resultados->bindParam(":nome_param", $pesq, PDO::PARAM_STR);
            $resultados->execute();
        
        }
        catch(PDOException $erro)
        {
            echo $erro->getMessage();
        }
    }
}