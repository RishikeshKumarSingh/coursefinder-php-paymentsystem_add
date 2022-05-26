<?php include "config.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CourseFinder</title>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <div class="container">
                        <a href="" class="navbar-brand">Course Finder</a>

                        <form action="" class="d-flex w-50">
                                <input type="search" name="search" class="form-control">
                                <input type="submit" class="btn btn-success" name="find">
                        </form>


                        <ul class="navbar-nav">
                                <li><a href="" class="nav-link text-white">Home</a></li>
                                <li><a href="" class="nav-link text-white">About</a></li>
                                <li><a href="" class="nav-link text-white">Logout</a></li>
                        </ul>
                </div>
        </nav>

        <div class="container">
                <div class="row mt-3">
                        <div class="col-3">
                               <form action="" method="post" enctype="multipart/form-data">
                                        <div class="mb-3">
                                                <label for="">Title</label>
                                                <input type="text" name="title" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                                <label for="">Instructor</label>
                                                <input type="text" name="instructor" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                                <label for="">Image</label>
                                                <input type="file" name="image" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                                <label for="">Discription</label>
                                                <input type="text" name="discription" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                                <label for="">Price</label>
                                                <input type="text" name="price" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                                <label for="">Discount-Price</label>
                                                <input type="text" name="discount_price" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                                <label for="">Duration</label>
                                                <input type="text" name="duration" class="form-control">
                                        </div>
                                        <input type="submit" name="submit" class="btn btn-warning">
                                </form>
                                <?php 
                                if(isset($_POST['submit'])){

                                        $attach= $_FILES['image']['name'];
                                        $tmp_attach=$_FILES['image']['tmp_name'];
                                        move_uploaded_file($tmp_attach,"attachment/$attach");

                                        $data=[
                                                'title'=>$_POST['title'],
                                                'instructor' =>$_POST['instructor'],
                                                'discription'=> $_POST['discription'],
                                                'price'=> $_POST['price'],
                                                'discount_price'=>$_POST['discount_price'],
                                                'duration'=>$_POST['duration'],
                                                'image' => $attach,
                                        ];
                                        insert("course",$data);
                                }
                                ?>
                        </div>
                        <div class="col-9">
                                <h4 class="h2">Manage Courses</h4>
                                <div class="row">
                                        <?php $data=calling("course");
                                        foreach($data as $row){
                                         ?>
                                       <div class="col-3">
                                       <div class="card mt-3">
                                                <div class="card">
                                                        <img src="attachment/<?=$row['image'];?>" alt="" class="w-1000" style="object-fit: cover;height:180px;">
                                                </div>
                                                <div class="card-body">
                                                        <h2><?=$row['title'];?></h2>
                                                        <h2 class="h4">Rs.<span><?=$row['discount_price'];?></span>Rs.<del><?=$row['price'];?></del></h2>
                                                        <form action="paytmKit/pgRedirect.php" method="post">
                                                                <input type="text" name="ORDER_ID">
                                                                <input type="text" name="CUST_ID">
                                                                <input type="text" name="TXN_AMOUNT">
                                                        <input type="submit" class="btn btn-primary" value="Pay">
                                                        </form>
                                                </div>
                                        </div>
                                       </div>
                                        <?php } ?>
                                </div>
                        </div>
                </div>
        </div>

</body>

</html>