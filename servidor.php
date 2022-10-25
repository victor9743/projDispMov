<?php
class Servidor {

    function __construct()
    {
        $rota = $_POST["rota"];
        switch($rota)
        {
            case "index":
                $this->getAll();
            break;
            case "new":
                $this->save($_POST["cpf"], $_POST["voto"]);
            break;
        }
        
    }

    function conexao($sql, $metodo){
         
        try
        {
            //Conectar
            $ligacao = new PDO("mysql:dbname=eleicao; host=localhost", "root", "");
        
            $resultados = $ligacao->prepare($sql);
            $resultados->execute();
            
            if($resultados->execute()){
                $data = $resultados->fetchAll();
            } else{
                $data = "erro";
            }
            return array("conexao" => true , "info" => $data);
        
        }
        catch(PDOException $erro)
        {
            echo $erro->getMessage();
        }
    }

    function getAll(){
        $sql = "SELECT count(*) FROM votacoes";
        header('Content-Type: application/json; charset=utf-8');
        $data = $this->conexao($sql, "getALL");
        if ( $data["conexao"]){  
            echo json_encode($data);
        }else{
            echo $data["conexao"];
        }
    }

    function save($cpf, $voto){
        $sql = "INSERT INTO votacoes (cpf, voto) values(:campo1, :campo2)";
        header('Content-Type: application/json; charset=utf-8');
        $data = $this->conexao($sql, "save");
        if ( $data["conexao"]){  
            echo json_encode($data);
        }else{
            echo $data["conexao"];
        }
    }
}

new Servidor();
