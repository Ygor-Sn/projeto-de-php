<?php
session_start(); //inicia sessão
if (!isset($_SESSION['login_session'])) {// se nao tiver logaoo
    echo'<center><h1>Redirecionando...</h1></center>';
    header("refresh:1; url=/index.html"); // joga para login
    exit();//termina 
}
session_destroy(); // destrui todos os dados da sessão
echo "<center><h1>Saindo...</h1><center>"; //informa ao usuario
header("refresh:2; url=/index.html"); // volta para login
