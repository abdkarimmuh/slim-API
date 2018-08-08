<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

$app->get("/notifikasi/", function (Request $request, Response $response){
    $sql = "SELECT * FROM llx_notifikasi";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $response->withJson(["status" => "success", "data" => $result], 200);
});

$app->get("/notifikasi/{id}", function (Request $request, Response $response, $args){
    $id = $args["id"];
    $sql = "SELECT * FROM llx_notifikasi WHERE fk_user=:id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([":id"=>$id]);
    $result = $stmt->fetch();
    return $response->withJson(["status" => "success", "data" => $result], 200);
});

$app->post("/notifikasi/", function (Request $request, Response $response){

    $notifikasi = $request->getParsedBody();

    $sql = "INSERT INTO llx_notifikasi (fk_user, n1, n2, n3, n4, n5, n6, n7, n8, n9, n10, n_now, datec) VALUES (:fk_user, :n1, :n2, :n3, :n4, :n5, :n6, :n7, :n8, :n9, :n10, :n_now, :datec)";
    $stmt = $this->db->prepare($sql);
    $date = date('m/d/Y', time());

    $data = [
        ":fk_user" => $notifikasi["fk_user"],
    	":n1" => $notifikasi["n1"],
        ":n2" => $notifikasi["n2"],
        ":n3" => $notifikasi["n3"],
        ":n4" => $notifikasi["n4"],
        ":n5" => $notifikasi["n5"],
        ":n6" => $notifikasi["n6"],
        ":n7" => $notifikasi["n7"],
        ":n8" => $notifikasi["n8"],
        ":n9" => $notifikasi["n9"],
        ":n10" => $notifikasi["n10"],
        ":n_now" => $notifikasi["n_now"],
        ":datec" => $date
    ];

    if($stmt->execute($data))
       return $response->withJson(["status" => "success", "data" => "1"], 200);
    
    return $response->withJson(["status" => "failed", "data" => "0"], 200);
});


$app->post("/notifikasi/{fk_user}/{n}", function (Request $request, Response $response, $args){

	$fk_user = $args["fk_user"];
    $n = $args["n"];
    $pesan = $args["pesan"];

    $notifikasi = $request->getParsedBody();

    $datec = date('m/d/Y', time());

    $sql1 = "UPDATE llx_notifikasi SET n1=:pesan, n_now=:n, datec=:datec WHERE fk_user=:fk_user";

    $sql2 = "UPDATE llx_notifikasi SET n2=:pesan, n_now=:n, datec=:datec WHERE fk_user=:fk_user";

    $sql3 = "UPDATE llx_notifikasi SET n3=:pesan, n_now=:n, datec=:datec WHERE fk_user=:fk_user";

    $sql4 = "UPDATE llx_notifikasi SET n4=:pesan, n_now=:n, datec=:datec WHERE fk_user=:fk_user";

    $sql5 = "UPDATE llx_notifikasi SET n5=:pesan, n_now=:n, datec=:datec WHERE fk_user=:fk_user";

    $sql6 = "UPDATE llx_notifikasi SET n6=:pesan, n_now=:n, datec=:datec WHERE fk_user=:fk_user";

    $sql7 = "UPDATE llx_notifikasi SET n7=:pesan, n_now=:n, datec=:datec WHERE fk_user=:fk_user";
    
    $sql8 = "UPDATE llx_notifikasi SET n8=:pesan, n_now=:n, datec=:datec WHERE fk_user=:fk_user";

    $sql9 = "UPDATE llx_notifikasi SET n9=:pesan, n_now=:n, datec=:datec WHERE fk_user=:fk_user";

    $sql10 = "UPDATE llx_notifikasi SET n10=:pesan, n_now=:n, datec=:datec WHERE fk_user=:fk_user";

    switch ($n) {
        case '1':
            $stmt = $this->db->prepare($sql1);
            break;
        case '2':
            $stmt = $this->db->prepare($sql2);
            break;
        case '3':
            $stmt = $this->db->prepare($sql3);
            break;
        case '4':
            $stmt = $this->db->prepare($sql4);
            break;
        case '5':
            $stmt = $this->db->prepare($sql5);
            break;
        case '6':
            $stmt = $this->db->prepare($sql6);
            break;
        case '7':
            $stmt = $this->db->prepare($sql7);
            break;
        case '8':
            $stmt = $this->db->prepare($sql8);
            break;
        case '9':
            $stmt = $this->db->prepare($sql9);
            break;
        case '10':
            $stmt = $this->db->prepare($sql10);
            break;
        
        default:
            # code...
            break;
    }

    $data = [
    	":fk_user" => $fk_user,
        ":n" => $n,
        ":datec" => $datec,
        ":pesan" => $notifikasi['pesan']
    ];

    if($stmt->execute($data))
       return $response->withJson(["status" => "success", "data" => "1"], 200);
    
    return $response->withJson(["status" => "failed", "data" => "0"], 200);
});