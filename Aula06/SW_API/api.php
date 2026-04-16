<?php 
    header("Content-type: application/json");

    $metodo = $_SERVER['REQUEST_METHOD'];

    
    echo "Método da requisição: ".$metodo;


    /*  $usuarios =[
        ["id" => 1, "nome" => "Maria Souza", "email" => "maria@email.com"],
        ["id" => 2, "nome" => "João Silva", "email" => "joao@email.com"]
    ]; */

    $arquivo = 'usuarios.json';

    if (!file_exists($arquivo)) {
        file_put_contents($arquivo, json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    $usuarios = json_decode(file_get_contents($arquivo), true);



    switch ($metodo) {
        case 'GET':

            echo json_encode($usuarios);
            break;

        case 'POST':


            
            $dados = json_decode(file_get_contents("php://input"), true);
            print_r($dados);

            $novo_usuario = [
                "id" => $dados["id"],
                "nome" => $dados["nome"],
                "email" => $dados["email"]
            ];

            array_push($usuarios, $novo_usuario);
            echo json_encode('Usuário Inserido com sucesso!');
            print_r($usuarios);
            
            $json = json_encode($usuarios);
            file_put_contents("usuarios.json", $json);


            
            break;

        default:
        
            echo "MÉTODO NÃO ENCONTRADO!";
            break;
    }


   
?>