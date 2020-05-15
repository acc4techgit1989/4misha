<?php  session_start();
require   __DIR__. '/../vendor/autoload.php';
        		    
        		   $auth = new Auth($_SESSION['login'], $_SESSION['password']);
        		   $auth->auth($_SESSION['login'], $_SESSION['password']);
        		   if(isset($_SESSION['login']))
        		   {
        		   $hello =  '<h3 class="text-center"><span class="emphasize">1 step:</span> complete</h3>
        		   <h4 class="text-center underline">glad to see you again ' .$_SESSION['login']  .'</h4>
        		   <a class="text-center" href="?is_exit">logout</a>';        		       
        		       if(isset($_GET['is_exit']))
        		       {
                               $auth->out();
                             header('Location: /view/index.php');        
        		       }
        		   }else
        		   {
        		       $hello =  '<h3 class="text-center"><span class="emphasize">1 step:</span> please 
                    <a href="#" data-toggle="modal" data-target="#exampleModal"> login </a> or 
                    <a class="text-center" href="#" data-toggle="modal" data-target="#exampleModa2"> register </a> here</h3>';
        		   }
        		   
        		 
        		   
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- meta -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- css -->
        <link rel="stylesheet" type="text/css" href="/style/style.css">
        <!-- bootstrap cdn-->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" 
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" 
        crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" 
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" 
        crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" 
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" 
        crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" 
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" 
        crossorigin="anonymous"></script>
        <!-- fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <!-- title -->
        <title>Simple Chat</title>
    </head>
    <body>
        <div class="container">
        	<div class="row">
        		<div class="col-6">   
        		   <?php 
        		   echo $hello;
        		   ?>
                    <!-- modal login -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                </div>
                            <div class="modal-body">
                     <!-- form -->
                               <form action="/app/Login.php" method="post">
                                    <div class="form-group">
                                       <label for="exampleInputPassword2">Login</label>
                                       <input type="text" name="login" class="form-control" id="exampleInputPassword2">
                                   </div>
                                   <div class="form-group">
                                       <label for="exampleInputPassword1">Password</label>
                                       <input type="password" class="form-control" id="exampleInputPassword1">
                                   </div>
                                   <button type="submit" class="btn btn-primary">Submit</button>
                               </form>
                     <!-- form -->
                        </div>
                            </div>
                        </div>
                    </div>
                    <!-- modal login -->
                    
                    <!-- modal register -->
                    <div class="modal fade" id="exampleModa2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabe2" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabe2">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                </div>
                            <div class="modal-body">
                     <!-- form -->
                               <form action="/app/Register.php" method="post">
                                   <div class="form-group">
                                       <label for="exampleInputPassword2">Login</label>
                                       <input type="text" name="login" class="form-control" id="exampleInputPassword2">
                                   </div>
                                   <div class="form-group">
                                       <label for="exampleInputEmail2">Email address</label>
                                       <input type="email" name="email" class="form-control" id="exampleInputEmail2" aria-describedby="emailHelp">
                                       <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                   </div>
                                   <div class="form-group">
                                       <label for="exampleInputPassword2">Password</label>
                                       <input type="password" name="password" class="form-control" id="exampleInputPassword2">
                                   </div>
                                   <button type="submit" class="btn btn-primary">Submit</button>
                               </form>
                     <!-- form -->
                        </div>
                            </div>
                        </div>
                    </div>
                    <!-- modal register -->
                    
                    <!-- chat -->
<div class="jumbotron">
  <h1 class="display-4">Привет, мир!</h1>
  <p class="lead">Имя категории: такое то</p>
  <hr class="my-4">
                    <?php 
                     // PDO
                     try
                     {
                         $db = new PDO('mysql:host=localhost;dbname=Simple_chat','root','');
                         foreach($db->query("SELECT * FROM comments ") as $row)
                         {
                             
                           echo "<p>    " .$row['text_of_comment'] ."</p><p class='lead'></p>";
                         };
                         $db = null;
                     }catch(PDOException $e)
                     {
                         print $e->getMessage();
                         exit;
                     }
                     // PDO
                     ?>
</div>
   
                    <!-- chat -->
                    
        		</div>
        		<div class="col-6">
                    <h3 class="text-center"><span class="emphasize">2 step:</span> Choose or create a category for your message</h3>
                           <?php  if(isset($_SESSION['login']))
                           {?>
                            
                            
  <form  action="/app/Store.php" method="post">
  <div class="form-group">
    <label for="exampleFormControlInput1">Create a category</label>
    <input type="text" name="category_name" class="form-control" id="exampleFormControlInput1" >
  </div>
  <button type="submit">create</button>
</form>
                    <h3 class="text-center mt-3"><span class="emphasize">3 step:</span>speak on any theme with frends</h3>
                     
                     <?php
   
                           
                           } ?>
                             
                             
<div class="span6">
<form method="POST" action="/app/Store.php">
                        <h3>Select a category:</h3>
<label for="exampleFormControlSelect1">select category</label>
    <select class="form-control" id="exampleFormControlSelect1" name="category_id">
<?php 
                    // PDO
                     try
                     {
                         $db = new PDO('mysql:host=localhost;dbname=Simple_chat','root','');
                         foreach($db->query("SELECT * FROM categoryes") as $row)
                         {
                            echo "<option value='$row[id]'>'$row[category_name]'</option>";
                         };
                         $db = null;
                     }catch(PDOException $e)
                     {
                         print $e->getMessage();
                         exit;
                     }
                     // PDO
      ?>                  
    </select>
    <div class="form-group">
    <label for="exampleFormControlInput1">Create a comment</label>
  </div>
    <div class="form-group">
    <input type="text" name="text_of_comment" class="form-control" id="exampleFormControlInput1" >
  </div>
    <div class="form-group">
    <button type="submit">submit</button>
  </div>
</form>
</div>




                 
                        
      
      
                     
                             
                             
                             
                             
                             
                             
                             
                             
                           
                     
                     
        		</div>
        	</div>
        </div>     
    </body>
</html>