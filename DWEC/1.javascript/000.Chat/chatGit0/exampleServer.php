<?php // WebSocket Server Example

include ("WebSocketServer.php");
$Address	= "192.168.100.13";
$Port		= 777;

class customServer extends WebSocketServer{
	function onData($SocketID, $M){
		$this->Log("Client #$SocketID > $M");
		$this->Write($SocketID, $M);
		
	}
}
$customServer = new customServer($Address, $Port);
$customServer->onOpening("acho");
$customServer->Start();
?>