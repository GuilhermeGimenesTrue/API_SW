<?php 
    header("Content-type: application/json");

    $metodo = $_SERVER['REQUEST_METHOD'];

    
    echo "Método da requisição: ".$metodo;

    switch ($metodo) {
        case 'GET':

            echo "AQUI AÇÕES DO MÉTODO GET";
            break;

        case 'POST':

            echo "AQUI AÇÕES DO MÉTODO POST";
        
        default:
        
            echo "MÉTODO NÃO ENCONTRADO!";
            break;
    }


   /*  $usuarios =[
        ["id" => 1, "nome" => "Maria Souza", "email" => "maria@email.com"],
        ["id" => 2, "nome" => "João Silva", "email" => "joao@email.com"]
    ];

    echo json_encode($usuarios);
 */
?>