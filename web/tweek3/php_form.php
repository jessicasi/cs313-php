<!DOCTYPE html>
​
<html>
​
<head>
</head>
​
<body>
    <main>
        <label>Name:
            <?php
            $name = $_POST['name'];
            echo $name;
            ?>
        </label>
        <br>
        <label>Email:
            <?php
            $email = $_POST['email'];
            echo "<a href='mailto:" . $email . "'>" . $email . "</a>";
            ?>
        </label>
        <br>
        <label>Major:
            <?php
            $major = $_POST['major'];
            echo $major;
            ?>
        </label>
        <br>
        <label>Comments:
            <?php
            $comments = $_POST['comments'];
            echo $comments;
            ?>
        </label>
        <label>Continents Visited:
           

            <?php
            $countries=array("na"=>"NorthAmerica","sa"=>"South America","eu"=>"Europe","ai"=>"Asia","as"=>"Australia","af"=>"Africa","ar"=>"Antarctica");
            if(isset($_POST['cont1'])){
                echo $countries[$_POST['cont1']]."<br>";
            }
            if(isset($_POST['cont2'])){
                echo $countries[$_POST['cont2']]."<br>";
            }
            if(isset($_POST['cont3'])){
                echo $countries[$_POST['cont3']]."<br>";
            }
            if(isset($_POST['cont4'])){
                echo $countries[$_POST['cont4']]."<br>";
            }
            if(isset($_POST['cont5'])){
                echo $countries[$_POST['cont5']]."<br>";
            }
            if(isset($_POST['cont6'])){
                echo $countries[$_POST['cont6']]."<br>";
            }
            if(isset($_POST['cont7'])){
                echo $countries[$_POST['cont7']]."<br>";
            }
       

            ?>
        </label>
    </main>
</body>
​
</html