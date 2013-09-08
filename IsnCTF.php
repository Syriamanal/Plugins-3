<?php
/*
__PocketMine Plugin__
name=IsnCTF
description=Capture the Flag plugin !
version=1.0
author=A9_0Z
class=IsnCTF
apiversion=9
*/
/*
Small Changelog
===============
Commit summary: Extended description: (optional)
A9-0Z samuelandrewmark@gmail.com

Commit summary: Extended description: (optional)
A9-0Z samuelandrewmark@gmail.com

1.0: Initial release
*/
class IsnCTF implements Plugin{
   private $api, $this, $path, $server, $config;
   private $nr = 0;
   private $interval;
    public function __construct(ServerAPI $api, $server = false){
        $this->api = $api;
    }
         public function init(){
         $this->api->addHandler("player.interact", array($this, "eventHandler"));       
         $this->api->addHandler("player.spawn", array($this, "eventHandler"));        
         $this->api->addHandler("player.block.place", array($this, "eventHandler"));
         $this->api->addHandler("player.block.break", array($this, "eventHandler"));
         $this->api->addHandler("player.equipment.change", array($this, "eventHandler")); 
                
         $GLOBALS['Red']= array('PlaceHold','PlaceHold1');
         $GLOBALS['Blue']= array('PlaceHold2','Placehold3');
         $GLOBALS['RedCount']= count($Red);
         $GLOBALS['BlueCount']= count($Blue);
         $GLOBALS['RedSC']= array();
         $GLOBALS['BlueSC']= array();
         $GLOBALS['BlueSCount']= count($BlueSC);
         $GLOBALS['RedSCount']= count($RedSC);
         $GLOBALS['PlayerCount']= count($this->api->player->getAll());
         
         $this->configSC = new Config($this->api->plugin->configPath($this) . "configSC.yml", CONFIG_YAML, array('interval' => 1, 'messages' => array("Example message")));
                $this->interval = $this->configSC->get("interval");
                $this->api->schedule(20 * 60 * $this->interval, array($this, "msg"), array(), false);
                
         $this->configST = new Config($this->api->plugin->configPath($this) . "configST.yml", CONFIG_YAML, array('interval' => 1.3, 'messages' => array("Example message")));
                $this->intervalSt = $this->configSC->get("interval");
                $this->api->schedule(20 * 60 * $this->intervalSt, array($this, "stop"), array(), false);
         
         $this->items = new Config($this->api->plugin->configPath($this)."items.yml", CONFIG_YAML, array(
                        '272' => '1',
                        '320' => '5'));
                        $this->items = $this->api->plugin->readYAML($this->api->plugin->configPath($this). "items.yml");
         }


    public function msg() {
    	global $BlueSC,$RedSC,$BlueSCount,$RedSCount;
    	        $GLOBALS['BlueSCount']= count($BlueSC);
                $GLOBALS['RedSCount']= count($RedSC);
                $messagesArray = $this->configSC->get("messages");
                
                        $message = $messagesArray[$this->nr];
                        $this->api->chat->broadcast("[ISN] " . 'Red Team Score = ' . $GLOBALS['RedSCount']);
                        $this->api->chat->broadcast("[ISN] " . 'Blue Team Score = ' . $GLOBALS['BlueSCount']);
                      
                        if ($this->nr < count($messagesArray)-1) {
                                $this->nr++;
                        
                        }
                
                $this->api->schedule(20 * 60 * $this->interval, array($this, "msg"), array(), false);
        }
         
   public function stop() {
    	global $BlueSC,$RedSC,$BlueSCount,$RedSCount;
    	        $GLOBALS['BlueSCount']= count($BlueSC);
                $GLOBALS['RedSCount']= count($RedSC);
                $messagesArray = $this->configSC->get("messages");
                
                        $message = $messagesArray[$this->nr];
                        $this->api->chat->broadcast("[ISN] " . 'There are 5 minutes remaining!');
                        
                      
                        if ($this->nr < count($messagesArray)-1) {
                                $this->nr++;
                        
                        }
                
                $this->api->schedule(20 * 60 * 1, array($this, "stop2"), array(), false);
        }
   
   public function stop2() {
    	global $BlueSC,$RedSC,$BlueSCount,$RedSCount;
    	        $GLOBALS['BlueSCount']= count($BlueSC);
                $GLOBALS['RedSCount']= count($RedSC);
                $messagesArray = $this->configSC->get("messages");
                
                        $message = $messagesArray[$this->nr];
                        $this->api->chat->broadcast("[ISN] " . 'There are 4 minutes remaining!');
                        
                      
                        if ($this->nr < count($messagesArray)-1) {
                                $this->nr++;
                        
                        }
                
                $this->api->schedule(20 * 60 * 1, array($this, "stop3"), array(), false);
        }
   
   public function stop3() {
    	global $BlueSC,$RedSC,$BlueSCount,$RedSCount;
    	        $GLOBALS['BlueSCount']= count($BlueSC);
                $GLOBALS['RedSCount']= count($RedSC);
                $messagesArray = $this->configSC->get("messages");
                
                        $message = $messagesArray[$this->nr];
                        $this->api->chat->broadcast("[ISN] " . 'There are 3 minutes remaining!');
                        
                      
                        if ($this->nr < count($messagesArray)-1) {
                                $this->nr++;
                        
                        }
                
                $this->api->schedule(20 * 60 * 1, array($this, "stop4"), array(), false);
        }
    
    public function stop4() {
    	global $BlueSC,$RedSC,$BlueSCount,$RedSCount;
    	        $GLOBALS['BlueSCount']= count($BlueSC);
                $GLOBALS['RedSCount']= count($RedSC);
                $messagesArray = $this->configSC->get("messages");
                
                        $message = $messagesArray[$this->nr];
                        $this->api->chat->broadcast("[ISN] " . 'There are 2 minutes remaining!');
                        
                      
                        if ($this->nr < count($messagesArray)-1) {
                                $this->nr++;
                        
                        }
                
                $this->api->schedule(20 * 60 * 1, array($this, "stop5"), array(), false);
        }
    
    public function stop6() {
    	global $BlueSC,$RedSC,$BlueSCount,$RedSCount;
    	        $GLOBALS['BlueSCount']= count($BlueSC);
                $GLOBALS['RedSCount']= count($RedSC);
                $messagesArray = $this->configSC->get("messages");
                if($RedSCount > $BlueSCount){$winners = 'The Red Team have won !!';}
                if($RedSCount < $BlueSCount){$winners = 'The Blue Team have won !!';}
                if($RedSCount = $BlueSCount){$winners = 'Ah Really Guys, a DRAW ?!!';}
                        $message = $messagesArray[$this->nr];
                        $this->api->chat->broadcast("[ISN] " . 'Match Finished Thanks for Playing!');
                        $this->api->chat->broadcast("[ISN] " . $winners );
                        $this->api->console->run("stop");
                        if ($this->nr < count($messagesArray)-1) {
                                $this->nr++;
                        
                        }
                
                
        }
    
    public function stop5() {
    	global $BlueSC,$RedSC,$BlueSCount,$RedSCount;
    	        $GLOBALS['BlueSCount']= count($BlueSC);
                $GLOBALS['RedSCount']= count($RedSC);
                $messagesArray = $this->configSC->get("messages");
                
                        $message = $messagesArray[$this->nr];
                        $this->api->chat->broadcast("[ISN] " . 'There is 1 minute remaining!');
                        
                      
                        if ($this->nr < count($messagesArray)-1) {
                                $this->nr++;
                        
                        }
                
                $this->api->schedule(20 * 60 * 1, array($this, "stop6"), array(), false);
        }
         
   public function eventHandler($data, $event)
	{
		global $Red,$Blue,$BlueCount,$RedCount,$username,$player;
		
		switch ($event) {
			case "player.spawn":
		          global $Red,$Blue,$BlueCount,$RedCount,$username,$player;
                          $GLOBALS['username']= $this->api->player->get($data->iusername);
                          $GLOBALS['player']= $data;
                          foreach($player->inventory as $slot => $data){
					if(isset($item) and $item->getID() !== $data->getID()){
						continue;
					}
					$player->setSlot($slot, BlockAPI::getItem(AIR, 0, 0));}
					
					foreach($player->armor as $slot => $data){
					if(isset($item) and $item->getID() !== $data->getID()){
						continue;
					}
					$player->setArmor($slot, BlockAPI::getItem(AIR, 0, 0));}
         
         $GLOBALS['RedCount']= count($Red);
         $GLOBALS['BlueCount']= count($Blue);
         
			    $search = array_search($username,$Blue);
                            if ($search !== FALSE){
                            $Blue = str_replace($username,'',$Blue);
                            $GLOBALS['Blue'] = array_filter($Blue);}

                            $search = array_search($username,$Red);
                            if ($search !== FALSE){
                            $Red = str_replace($username,'',$Red);
                            $GLOBALS['Red'] = array_filter($Red);}

                         
			   if ($RedCount < $BlueCount){
		       array_push($GLOBALS['Red'],$username);
			      $player->setArmor(0, BlockAPI::getItem(LEATHER_CAP, 0, 0));
			      $player->setArmor(2, BlockAPI::getItem(LEATHER_PANTS, 0, 0));
			      $username->sendChat('You are now a member of team Red !');
			   } 
			   if ($RedCount >= $BlueCount){
	                array_push($GLOBALS['Blue'],$username);
	               
			      $player->setArmor(0, BlockAPI::getItem(DIAMOND_HELMET, 0, 0));
			      $username->sendChat('You are now a member of team Blue !');
			   }
			   
			   foreach($this->items as $id => $count){
				$player->addItem((int)$id, 0, (int)$count);}
			        $player->setArmor(1, BlockAPI::getItem(CHAIN_CHESTPLATE, 0, 0));
			   break;
		
		        case "player.equipment.change":
		        	safe_var_dump($data);
		        	break;
		
		        case "player.block.break":
		        	global $Red,$Blue,$BlueCount,$RedCount,$RedSC,$BlueSC;
	        $username = $data["player"]->username;
		$target = $data["target"];
		if ($target->getID() === 35){ 
			if ($target->getMetadata() === 14){ 
			  $search = array_search($GLOBALS['username'],$GLOBALS['Blue']);
                           if ($search !== FALSE){
                           $this->api->chat->broadcast("[ISN] " . 'Red Flag Stolen by ' . $username . '!');
                           return true;
                           }
                           if ($search === FALSE){ 
                           	return false;
                           }
			}
			if ($target->getMetadata() === 11){
				$search = array_search($GLOBALS['username'],$GLOBALS['Red']);
                           if ($search !== FALSE){
                           $this->api->chat->broadcast("[ISN] " . 'Blue Flag Stolen by ' . $username . '!'); 
                           return true;
                           }
                           if ($search === FALSE){return false;
                           }
			}
		} if ($target->getID() !== 35){
			return false;}
		        break;
		
                        case "player.block.place":
                           global $Red,$Blue,$BlueCount,$RedCount,$player,$RedSC,$BlueSC;
                           
      $target = $data["block"];
      $item = $data["item"];
      $username = $data["player"]->username;
      if ($item->getID() === 35){ 
      	if ($item->getMetadata() === 14){ 
             $search = array_search($username,$Blue);
             if ($search !== FALSE){
      		$x = $target->x;
                $y = $target->y;
                $z = $target->z;
                if(65 <= $x and $x <= 67){if(64<= $y and $y <= 66){if(63<= $z and $z <= 65){
                        $this->api->chat->broadcast("[ISN] " . 'Blue Team Scored !');	
                	$this->api->chat->broadcast('Flag Captured by ' . $username . ' !');
                	
                	 array_push($GLOBALS['BlueSC'],$username);
                	 usleep(5);
                	 $level->setBlockRaw(new Vector3(64, 64, 64), $air, false, true);
                    }}	
                }
                
          }
     }
}
        if ($item->getID() === 35){
      	if ($item->getMetadata() === 11){
             $search = array_search($username,$Red);
             if ($search !== FALSE){
      		$x = $target->x;
                $y = $target->y;
                $z = $target->z;
                if(65 <= $x and $x <= 67){if(64<= $y and $y <= 66){if(63<= $z and $z <= 65){
                        $this->api->chat->broadcast("[ISN] " . 'Red Team Scored !');	
                	$this->api->chat->broadcast('Flag Captured by ' . $username . ' !');
                	 array_push($GLOBALS['RedSC'],$username);
                	usleep(5);
                	$send = true;
                	$air = new AirBlock();
                	 $level->setBlockRaw(new Vector3($x, $y, $z), $air, false, $send);
                
                }}}
             }
        }
     }                 break;
      
      
			case "player.interact":
			   global $Red,$Blue,$BlueCount,$RedCount;	
			
      $username = $data["player"]->username;
      $player = $this->api->player->getbyEID($data["entity"]->eid);
      $target = $this->api->player->getbyEID($data["targetentity"]->eid);
     /* if($source != instanceof Player or $target != instanceof Player) {
       $this->throwUnhandledErrorException(NOT_OBJECT);
      } else { */
      $usernameP = $player->username; 
       $target = $target->username;
   
                           $search = array_search($target,$Blue);
                           if ($search !== FALSE){ $GLOBALS['tarteam'] = 'Blue'; }
                           $search = array_search($target,$Red);
                           if ($search !== FALSE){ $GLOBALS['tarteam'] = 'Red'; }
                           $search = array_search($usernameP,$Red);
                           if ($search !== FALSE){ $GLOBALS['plateam'] = 'Red'; }
                           $search = array_search($usernameP,$Blue);
                           if ($search !== FALSE){ $GLOBALS['plateam'] = 'Blue'; }
                           global $tarteam,$plateam;
                           if($tarteam === $plateam ){
                           $player->sendChat("Player is on your team !!");
                           return false;
                           }
	 
			   break;}}
	 public function __destruct(){
global $Red,$Blue,$BlueCount,$RedCount;	 	
unset($GLOBALS['Red']);
unset($GLOBALS['Blue']);
    }
 }
         ?>
