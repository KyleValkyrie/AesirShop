<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Electrolize' rel = 'stylesheet'>
    <title>Aesir Store</title>
</head>
<style>
    body
    {
        background-color: black;
        font-family: 'Electrolize';
    }
    table
    {
        margin-left: auto;
        margin-right: auto;
        background-color:black;
        color:white;
        width:80%;
        border: 1px solid;
        border-spacing: 3px;
    }
    th, td
    {
    padding: 10px;
    }
    img
    {
        width:200px;
        height:150px;
    }
    tr
    {
        height:50px;
    }
    #welcome
    {
        font-size: 40px;
    }
    #logo
    {
        position:absolute;
        left:30px;
        top:-25px;
        width:200px;
        height:150px;
    }
    #message
    {
        font-size: 25px;
    }
    #header
    {
        height: 50px;
        background-color:#220C0C ;
        text-align: center;
        padding-top: 25px;
    }
    #backgroundHomepage
    {
        padding-bottom: 10px;
        background-image: url("upscaled_artwork.jpg");
        filter: blur(1px);
        background-repeat: no-repeat;
        background-size: cover;
        height: 720px;
    }
    .content
    {
        position:absolute; /* or absolute */
        color: white;
        text-align: center;
        font-size: 15px;
        position: absolute;
        top:  50%;
        left: 50%;
        transform: translate(-50%,-50%)
    }
    ul.menu
    {
        margin :0px;
        padding:0px;
    }
    li.menu
    {
        display: inline;
        font-size:  = 20px;
    }
    a.menu
    {
        color : white;
        margin-right: 50px;
        padding: 10px;
        text-decoration: none;

    }
    a.menu:hover
    {
        background-color: #660D1A;
        color: white;
    }
    a.active
    {
        background-color: white;
        color: #F5331F ;
    }
    button, input[type = submit]
    {
        padding: 10px;
        margin:5px;
    }
    #content
    {
        padding-top: 20px;
    }
    #action
    {
        margin-top: :20px;

    }
</style>
<body>
    <!-- header for index page -->
    <div id ="header">
        <img id = "logo" src="logo.png" alt="logoimage">
        <?php
        //get db config
        include_once("db_config.php");
        //conditioning for id
        $idPage = null;
        if(isset($_GET["id"]))
        {
            $idPage = $_GET["id"];
        }
        //setup connection
        $cnPage = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);
        if($cnPage->connect_error)
        {
            die("Error connecting: ". $cnPage->connect_error);
        }
        $sqlPage = "select id, title from navpages order by id";
        $resultPage = $cnPage->query($sqlPage);
        echo "<ul class ='menu'>";
        while($rowPage = $resultPage->fetch_assoc())
        {
            if($idPage === null)
            {
                $idPage = $rowPage["id"];
            }
            $activePage = "";
            if($rowPage["id"] == $idPage)
            {
                $activePage = "active";
            }
            echo "<a class = 'menu {$activePage}' href = '?id={$rowPage['id']}'> <li class ='menu'>{$rowPage['title']}</li></a>";
        }
        echo "</ul>";
        ?>
        </div>
        <?php
         switch ($idPage)
         {
            //homepage content
            default:
            case "1":  
                //background image
                echo "<div id ='backgroundHomepage'></div>";
                //content for index page
                echo "<div class = 'content'>";
                echo "<p id ='welcome'>
                Welcome to Æsir Store!
                </p>";
                echo "<p id = 'message'>
                    Fusce erat dui, venenatis et erat in, vulputate dignissim lacus. <br>
                    Donec vitae tempus dolor,sit amet elementum lorem. <br>
                    Ut cursus tempor turpis.
                </p>";
                echo "</div>";
            break;
                //categories content
            case "2":
                
            break;
                //news content
            case"3":

            break;
                //contact content
            case"4":

            break;
                //blog content
            case"5":
                $idBlog = null;
                $cnBlog = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);
                if($cnBlog->connect_error)
                {
                    die("Error connecting: ". $cnBlog->connect_error);
                }
                $sqlBlog = "select id, title, description, imageLink from blogs order by id";
                $resultBlog = $cnBlog->query($sqlBlog);
                while($rowBlog = $resultBlog->fetch_assoc())
                {
                    if($idBlog === null)
                    {
                        $idBlog = $rowBlog["id"];
                    }
                    echo "<table>";
                    echo "<tr>
                        <td id ='img' colspan ='1' rowspan ='2'><img src = '{$rowBlog['imageLink']}'></td>
                        <td id ='name'>{$rowBlog['title']}</td>
                    </tr>";  
                    echo "<tr>
                    <td>{$rowBlog['description']}</td>
                    </tr>";
                    echo "</table>";              
                }    
            break;
         }
        
        ?>
</body>
</html>