<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/9179c9d0f1.js" crossorigin="anonymous"></script>

  </head>
  <body>
    <div class="Tout">
        <div class="A">
            <h1>DAHSBOARD</h1> <br>
            <img src="font/Image.jpg" alt="" width="60px"> <p class="nom" >{{ $nom }} {{ $prenoms }}</p> <br>

            <a href="/professeur-emploi">EMPLOI DU TEMPS</a> <br>
            <br>
            <br>
            <a href="/professeur-paiement">MES PAIEMENTS</a> <br>
            <br>
            <br>
            <a href="/message">CONTACTER L'ADMINISTRATION</a>
            <br>
            <br>
            <br>
            <br>
            <div class="logout">
                <a href="/deconnexion/utilisateur" >DECONNEXION</a>
            </div>



        </div>
        <div class="B">

    
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
  <style>
    body{
        margin: 0px;
        padding: 0px;
    }
    .Tout{
        display: flex;
    }
    .A{
        padding-left: 0px;
        background-color: aliceblue;
        width: 350px;
        height: 551px;
    }


    .A h1{
        margin-left: 30px;
        font-family:  Times, serif;
        font-weight: bold;
        font-size: 35px;

    }
    .A select{
        margin-left: 40px;
        width: 290px;
        height: 40px;
        font-family:  Times, serif;



    }
    .A a{
        padding: 5px;
        font-family:  Times, serif;
        font-size: 20px;
        line-height: 2.5;
        text-decoration: none;
        font-weight: bold;
        margin-left:5px ;

    }
    .X:hover {
        background-color: blanchedalmond;
        color: black;

    }
    .B a{
        background-color:rgb(4, 238, 234) ;
        color:white;
        border: 1px solid;
        border-radius: 5px;

    }

    hr{
        border: 2px solid;
        margin-left: 0px;
        font-weight: bold;
    }
    .logout a{
        background-color: rgba(145, 2, 2, 0.827);
        color: white;
        width: 200px;
        border-radius: 5px;
    }

    .nom{
        position: fixed;
        margin-left:80px;
        font-family:  Times, serif;
        font-size: 20px;
        margin-top:-45px;
        font-weight: bold;
    }
    img{
        border-radius:15px;

    }

    </style>
</html>