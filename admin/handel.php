<?php

    define("ROOT_PATH","/My-Github/break-time/admin/handel.php");

    $requstURI = str_replace(ROOT_PATH,"", $_SERVER['REQUEST_URI']);
    
    // Services

    // Get All
    if($requstURI == "/services" && $_SERVER['REQUEST_METHOD'] === "GET"){
        try {
            $conn = new  mysqli('localhost','root','','breaktime','3306');
        } catch (\Throwable $th) {
            die('connection failed .. !! '.$th->getMessage());
        }
    
        $result = $conn->query('SELECT services.id as id ,services.name as name ,services.price as price ,supplier.name as supplier  FROM services JOIN supplier ON services.supplierId=supplier.id');
        $conn->close();
        $rows = [];
    
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
    
        header('Content-Type: application/json');
    
        echo json_encode($rows);
    } 

    // Get One

    if(str_contains($requstURI,'/services/?id') && $_SERVER['REQUEST_METHOD'] === "GET"){
        $servId = $_GET['id'];
        try {
            $conn = new  mysqli('localhost','root','','breaktime','3306');
        } catch (\Throwable $th) {
            die('connection failed .. !! '.$th->getMessage());
        }

        $result = $conn->query("Select * from services where id = $servId");
        $author = 
        $conn->close();
        $rows = [];
    
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
    
        header('Content-Type: application/json');
    
        echo json_encode($rows);


    }

    // Add
    if($requstURI == "/services" && $_SERVER['REQUEST_METHOD']=== "POST"){
        $name = $_POST['name'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $supplier = $_POST['supplier'];
        $description = $_POST['description'];
        $uploadDir = '../assets/upload/'; 
        $fileName = basename($_FILES['upload']['name']);
        $uploadFile = $uploadDir . basename($_FILES['upload']['name']);
        move_uploaded_file($_FILES['upload']['tmp_name'], $uploadFile);
        // if (!move_uploaded_file($_FILES['upload']['tmp_name'], $uploadFile)) {
        //     echo "File upload failed.\n";
        // }
        try {
            $conn = new  mysqli('localhost','root','','breaktime','3306');
        } catch (\Throwable $th) {
            die('connection failed .. !! '.$th->getMessage());
        }

        $stmt = $conn->prepare("INSERT INTO services (name , description , categoryId , supplierId , imgUrl , price) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiiss", $name , $description , $category , $supplier , $fileName , $price);
        $result=$stmt->execute();
        $stmt->close();
        $conn->close();
        echo json_encode($result);
    }

    // Edit
    if(str_contains($requstURI,'/services/?id')  && $_SERVER['REQUEST_METHOD'] === "POST"){
        $servId = $_GET['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $supplier = $_POST['supplier'];
        $description = $_POST['description'];
        $uploadDir = '../assets/upload/'; 
        try {
            $conn = new  mysqli('localhost','root','','breaktime','3306');
        } catch (\Throwable $th) {
            die('connection failed .. !! '.$th->getMessage());
        }
        if(!empty($_FILES['upload']['name'])){
            $fileName = basename($_FILES['upload']['name']);
            $uploadFile = $uploadDir . basename($_FILES['upload']['name']);
            move_uploaded_file($_FILES['upload']['tmp_name'], $uploadFile);
    
            $stmt = $conn->prepare("UPDATE services SET name = ? , price = ? , description = ? , categoryId = ? , imgUrl = ? , supplierId = ? WHERE id = ?");
            $stmt->bind_param("sssisii", $name, $price , $description, $category, $fileName,$supplier,$servId);
            $result = $stmt->execute();
            $stmt->close();
            echo json_encode($result);
        } else {
            $stmt = $conn->prepare("UPDATE services SET name = ? , price = ?  , description = ?, categoryId = ?, supplierId = ? WHERE id = ?");
            $stmt->bind_param("sssiii", $name, $price , $description, $category,$supplier, $servId);
            $result = $stmt->execute();
            $stmt->close();
            echo json_encode($result);
        } 
    }

    // Delete

    if(str_contains($requstURI,'/services/?id') && $_SERVER['REQUEST_METHOD'] ==="DELETE"){
        $servId = $_GET['id'];
        try {
            $conn = new  mysqli('localhost','root','','breaktime','3306');
        } catch (\Throwable $th) {
            die('connection failed .. !! '.$th->getMessage());
        }

        $result = $conn->query("DELETE from services where id=$servId");
        $conn->close();
    
        header('Content-Type: application/json');
    
        echo json_encode($result);
    }    


    // Categories

    // Get All
    if($requstURI == "/categories" && $_SERVER['REQUEST_METHOD'] === "GET"){
        try {
            $conn = new  mysqli('localhost','root','','breaktime','3306');
        } catch (\Throwable $th) {
            die('connection failed .. !! '.$th->getMessage());
        }
    
        $result = $conn->query('SELECT id, name FROM category');
        $conn->close();
        $rows = [];
    
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
    
        header('Content-Type: application/json');
    
        echo json_encode($rows);
    }

     // Get One

     if(str_contains($requstURI,'/categories/?id') && $_SERVER['REQUEST_METHOD'] === "GET"){
        $catId = $_GET['id'];
        try {
            $conn = new  mysqli('localhost','root','','breaktime','3306');
        } catch (\Throwable $th) {
            die('connection failed .. !! '.$th->getMessage());
        }

        $result = $conn->query("Select * from category where id = $catId");
        $author = 
        $conn->close();
        $rows = [];
    
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
    
        header('Content-Type: application/json');
    
        echo json_encode($rows);


    }

    // Add
    if($requstURI == "/categories" && $_SERVER['REQUEST_METHOD']=== "POST"){
        $name = $_POST['name'];

        try {
            $conn = new  mysqli('localhost','root','','breaktime','3306');
        } catch (\Throwable $th) {
            die('connection failed .. !! '.$th->getMessage());
        }

        $stmt = $conn->prepare("INSERT INTO category (name ) VALUES (?)");
        $stmt->bind_param("s", $name);
        $result=$stmt->execute();
        $stmt->close();
        $conn->close();
        echo json_encode($result);
    }

    // Edit
    if(str_contains($requstURI,'/categories/?id')  && $_SERVER['REQUEST_METHOD'] === "POST"){
        $catId = $_GET['id'];
        $name = $_POST['name'];
        try {
            $conn = new  mysqli('localhost','root','','breaktime','3306');
        } catch (\Throwable $th) {
            die('connection failed .. !! '.$th->getMessage());
        } 

        $stmt = $conn->prepare("UPDATE category SET name = ? WHERE id = ?");
        $stmt->bind_param("si", $name, $catId);
        $result = $stmt->execute();
        $stmt->close();
        echo json_encode($result);  
    }

    // Delete

    if(str_contains($requstURI,'/categories/?id') && $_SERVER['REQUEST_METHOD'] ==="DELETE"){
        $servId = $_GET['id'];
        try {
            $conn = new  mysqli('localhost','root','','breaktime','3306');
        } catch (\Throwable $th) {
            die('connection failed .. !! '.$th->getMessage());
        }

        $result = $conn->query("DELETE from category where id=$servId");
        $conn->close();
    
        header('Content-Type: application/json');
    
        echo json_encode($result);
    }    

    // Suppliers

    // Get All
    if($requstURI == "/suppliers" && $_SERVER['REQUEST_METHOD'] === "GET"){
        try {
            $conn = new  mysqli('localhost','root','','breaktime','3306');
        } catch (\Throwable $th) {
            die('connection failed .. !! '.$th->getMessage());
        }
    
        $result = $conn->query('SELECT id, name, phone, address FROM supplier');
        $conn->close();
        $rows = [];
    
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
    
        header('Content-Type: application/json');
    
        echo json_encode($rows);
    }

    // Get One

    if(str_contains($requstURI,'/suppliers/?id') && $_SERVER['REQUEST_METHOD'] === "GET"){
        $supId = $_GET['id'];
        try {
            $conn = new  mysqli('localhost','root','','breaktime','3306');
        } catch (\Throwable $th) {
            die('connection failed .. !! '.$th->getMessage());
        }

        $result = $conn->query("Select * from supplier where id = $supId");
        $author = 
        $conn->close();
        $rows = [];
    
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
    
        header('Content-Type: application/json');
    
        echo json_encode($rows);


    }

    // Add
    if($requstURI == "/suppliers" && $_SERVER['REQUEST_METHOD']=== "POST"){
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        try {
            $conn = new  mysqli('localhost','root','','breaktime','3306');
        } catch (\Throwable $th) {
            die('connection failed .. !! '.$th->getMessage());
        }

        $stmt = $conn->prepare("INSERT INTO supplier (name , phone , address) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name , $phone , $address);
        $result=$stmt->execute();
        $stmt->close();
        $conn->close();
        echo json_encode($result);
    }

    // Edit
    if(str_contains($requstURI,'/suppliers/?id')  && $_SERVER['REQUEST_METHOD'] === "POST"){
        $supId = $_GET['id'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        try {
            $conn = new  mysqli('localhost','root','','breaktime','3306');
        } catch (\Throwable $th) {
            die('connection failed .. !! '.$th->getMessage());
        }

        $stmt = $conn->prepare("UPDATE supplier SET name = ? , phone = ?  , address = ? WHERE id = ?");
        $stmt->bind_param("sssi", $name, $phone,$address, $supId);
        $result = $stmt->execute();
        $stmt->close();
        echo json_encode($result);
         
    }

    // Delete

    if(str_contains($requstURI,'/suppliers/?id') && $_SERVER['REQUEST_METHOD'] ==="DELETE"){
        $supId = $_GET['id'];
        try {
            $conn = new  mysqli('localhost','root','','breaktime','3306');
        } catch (\Throwable $th) {
            die('connection failed .. !! '.$th->getMessage());
        }

        $result = $conn->query("DELETE from supplier where id=$supId");
        $conn->close();
    
        header('Content-Type: application/json');
    
        echo json_encode($result);
    }    
?>