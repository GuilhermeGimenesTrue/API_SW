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

            echo json_encode($usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            break;

        case 'POST':


            
            $dados = json_decode(file_get_contents("php://input"), true);
            print_r($dados);

            if (!isset($dados["id"]) || !isset($dados["nome"]) || !isset($dados["email"])){
                http_response_code(400);
                echo json_encode(["erro" => "Dados incompletos"], JSON_UNESCAPED_UNICODE);
                exit;
            }


            $novo_usuario = [
                "id" => $dados["id"],
                "nome" => $dados["nome"],
                "email" => $dados["email"]
            ];

            $usuarios[] = $novo_usuario;

            file_put_contents($arquivo, json_encode($usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            echo json_encode(["mensagem" => "Usuário Inserido com sucesso!", "usuarios" => $usuarios], JSON_UNESCAPED_UNICODE);
            break;

          /*   
            array_push($usuarios, json_encode($novo_usuario, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) );
            
            print_r($usuarios);
            
            $json = json_encode($usuarios);
            file_put_contents("usuarios.json", $json); */


            
            break;

        default:
            
            http_response_code(405);
            echo json_encode(["erro" => "MÉTODO NÃO ENCONTRADO!"], JSON_UNESCAPED_UNICODE);
            break;
    }


   
?>