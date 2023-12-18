<?php

    $database = json_decode(file_get_contents('../assets/app.json'), true)['database'];

    try {
        $conn = new mysqli($database[0]['host'], $database[0]['user'], $database[0]['password'],$database[0]['database']);
    } catch (\Throwable $th) {
        die('connection failed .. !! '.$th->getMessage());
    }

    $result = $conn->query("SELECT * from services");

    $services = [];
    
    while ($row = mysqli_fetch_assoc($result)) {
        $services[] = $row;
    }
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/lib/bootstrap.min.css">
    <title>Services</title>
</head>
    <style>

        *{
            font-family: fantasy;
        }

        .card{
            cursor: pointer;
            transition: all 0.5s ease;
        }

        .card:hover{
            transform: scale(1.09);
        }

        .row{
            row-gap: 3rem;
        }

    </style>
<body>
<div class="container my-5">
    <h1 class="text-center">MENU</h1>
<div class="row row-cols-3 my-5">
   <?php foreach($services as $service){ ?>
        <div class="col">
            <div class=card>
            <img style="width:100%;height:15vw" src="../assets/upload/<?php echo $service['imgUrl']?>" alt="Loading">
            <div class="card-body">
                <div class="card-title">
                    <p class="text-center"><?php echo $service['name']?></p>
                </div>
                <p style="color:red" class="text-end"><?php echo $service['price']?></p>
                <div class="card-text">
                <small class="text-center"><?php echo $service['description']?></small>
                </div>
            </div>
            </div>
        </div>   
    <?php  }  ?>
</div>
</div>



