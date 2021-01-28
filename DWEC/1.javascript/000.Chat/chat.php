<?php 
function newChat($memberID, $chatID = null){
    if(is_null($chatID)){
        contadorPP($memberID);
        $chatID = $memberID.getContador($memberID);
    }
    fopen("chats/".$chatID.".txt","w") or die("UNABle to open file");
    $memberFile = fopen(glob("usuarios/".$memberID."(*).txt")[0], "a+") or die("UNable to open file");
    fwrite($memberFile, $chatID."\n");
    fclose($memberFile);
    


}

function getContador($memberID){
    $ruta = "usuarios/$memberID(*).txt";
    $archivo = glob($ruta)[0];
    return substr($archivo, strpos($archivo, "(")+1, strpos($archivo, ")") - strpos($archivo, "(") -1);
}

function contadorPP($memberID){
    $contador = (int)getContador($memberID) + 1;
    $ruta = "usuarios/$memberID(*).txt";
    $nombreArchivo = glob($ruta)[0];
    rename($nombreArchivo, "usuarios/$memberID($contador).txt");
}

//chats(nombre:chatID contenido: mensajes)
//usuarios(nombre:userID(contadorConver) contenido: chatIDs)
function newMessage($text, $memberID, $chatID){
    //(\Y-\m-\d \H:\i:\s)
    $chatFile = fopen("chats/$chatID.txt", "a+");
    
    fwrite($chatFile,"(".date("Y-m-d H:i:s")."){".$memberID."}[".$text."]\n");
}

function getLastmessages($chatID, $numberOfMessages = 20){
    $array20messages = array();

    $chatFile = fopen("chats/$chatID.txt","r");
    

    $cursor = -1;

    fseek($chatFile, $cursor, SEEK_END);
    $caracterActual= fgetc($chatFile);

    

    while($numberOfMessages--){
        
    while($caracterActual === "\n" || $caracterActual === "\r"){
        fseek($chatFile, $cursor--, SEEK_END);
        $caracterActual = fgetc($chatFile);
        
    }

    $line = "";

    while($caracterActual !== false && $caracterActual !== "\n" && $caracterActual != "\r"){
        $line = $caracterActual.$line;
        
        fseek($chatFile, $cursor--, SEEK_END);
        $caracterActual = fgetc($chatFile);
        
    }

    if($line == "")break;

    $aux = strpos($line, "(")+1;
    $fecha = substr($line, $aux, strpos($line, ")")- $aux);
    $aux = strpos($line, "{")+1;
    $memberID = substr($line, $aux, strpos($line, "}")- $aux);
    $aux = strpos($line, "[")+1;
    $texto = substr($line, $aux, strpos($line, "]")- $aux);
    $array20messages[] = array("date"=> $fecha, "uid" => $memberID, "text"=> $texto);
}

fclose($chatFile);
return $array20messages;
}

//echo newMessage("hi, I'm 20yo, I am a web application development student, I joined this course because one of my main passions is programming.", "69", "693");
//newMessage("Mi gato se ha comido al pajarillo tio :(", 'pablin', '693');
$__server_listening = true;

if($socket1 = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)){
    echo socket_strerror(socket_last_error());
    var_dump($socket1);
    print_r($socket1);
}
$address1 = (false)?"192.168.100.13":"127.0.0.1";
$port1 = 777;

/* if(socket_bind($socket1, $address1, $port1)){
    echo "socket1 binded to {$address1}:{$port1}<br>";
}
if(socket_connect($socket1, $address1, $port1)){
    echo "socket1 connected to {$address1}:{$port1}<br>";
} 
if(socket_listen($socket1, SOMAXCONN)){
    echo "socket1 listening on {$address1}:{$port1}<br>";
}

do {
    if ($mesaggesock1 = @socket_accept($socket1)){
        
    }
} while($__server_listening); */

echo socket_strerror(socket_last_error());



if(isset($_POST['status']) && $_POST['status']){
    if($_POST['status'] == 'changeChat' && isset($_POST['chatID']) && $_POST['chatID']){
        echo json_encode( getLastmessages($_POST['chatID']));
    }
}
?>