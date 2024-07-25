<?php
// sistema para conectar ao banco, está fora do codigo para facilitar sua modificação futura e uso em outras areas

$conn = new mysqli('localhost', 'root', '', 'escola'); //função new mysqli estabeleçe uma nova conexão com banco

$conn->set_charset("utf8"); // define como os caracter devem voltar
