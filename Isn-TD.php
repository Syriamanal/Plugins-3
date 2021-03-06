<?php
/*
__PocketMine Plugin__
name=IsnCTF
description=Capture the Flag plugin !
version=1.0
author=A9_0Z
class=IsnCTF
apiversion=9,10,11,12,13,14,
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
    public $level;
    private $nr = 0;
    private $timer = 0;
    private $interval;

    public function __construct(ServerAPI $api, $server = false){
        $this->api = $api;
    }

    public function init(){
        $this->api->addHandler("player.interact", array($this, "eventHandler"));
        $this->api->addHandler("player.spawn", array($this, "eventHandler"));
        $this->api->addHandler("player.quit", array($this, "eventHandler"));
        $this->api->addHandler("player.death", array($this, "eventHandler"));
        $this->api->addHandler("player.armor", array($this, "eventHandler"));
        $this->api->addHandler("player.drop", array($this, "eventHandler"));
               
        $GLOBALS['Red']= array('PlaceHold','PlaceHold1');
        $GLOBALS['Blue']= array('PlaceHold2','Placehold3');
        $GLOBALS['RedCount']= count(isset($Red));
        $GLOBALS['BlueCount']= count(isset($Blue));
        $GLOBALS['RedSC']= array();
        $GLOBALS['BlueSC']= array();
        $GLOBALS['BlueSCount']= count(isset($BlueSC));
        $GLOBALS['RedSCount']= count(isset($RedSC));
        $GLOBALS['PlayerCount']= count($this->api->player->getAll());
        $GLOBALS['level']= $this->api->level->getDefault();
         
        $this->configSC = new Config($this->api->plugin->configPath($this) . "configSC.yml", CONFIG_YAML, array('interval' => 1, 'messages' => array("Example message")));
            $this->interval = $this->configSC->get("interval");
            $this->api->schedule(20 * 60 * $this->interval, array($this, "msg"), array(), false);
               
        $this->configST = new Config($this->api->plugin->configPath($this) . "configST.yml", CONFIG_YAML, array('interval' => 1.3, 'messages' => array("Example message")));
            $this->intervalSt = $this->configSC->get("interval");
            $this->api->schedule(20 * 60 * $this->intervalSt, array($this, "gameTime"), array(), true);
         
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

    public function gameTime() {
        $messagesArray = $this->configSC->get("messages");
        switch($this->timer) {
            case 0:
                global $BlueSC,$RedSC,$BlueSCount,$RedSCount;
                    $GLOBALS['BlueSCount']= count($BlueSC);
                    $GLOBALS['RedSCount']= count($RedSC);
                    $message = $messagesArray[$this->nr];
                    $this->api->chat->broadcast("[ISN] " . 'There are 10 minutes remaining!');
                    if($this->nr < count($messagesArray)-1) {$this->nr++;}
                    $this->timer++;
                break;
            case 1:
                global $BlueSC,$RedSC,$BlueSCount,$RedSCount;
                    $GLOBALS['BlueSCount']= count($BlueSC);
                    $GLOBALS['RedSCount']= count($RedSC);
                    $message = $messagesArray[$this->nr];
                    $this->api->chat->broadcast("[ISN] " . 'There are 8 minutes remaining!');
                    if($this->nr < count($messagesArray)-1) {$this->nr++;}
                    $this->timer++;
                break;
            case 2:
                global $BlueSC,$RedSC,$BlueSCount,$RedSCount;
                    $GLOBALS['BlueSCount']= count($BlueSC);
                    $GLOBALS['RedSCount']= count($RedSC);
                    $message = $messagesArray[$this->nr];
                    $this->api->chat->broadcast("[ISN] " . 'There are 6 minutes remaining!');
                    if($this->nr < count($messagesArray)-1) {$this->nr++;}
                    $this->timer++;
                break;
            case 3:
                global $BlueSC,$RedSC,$BlueSCount,$RedSCount;
                    $GLOBALS['BlueSCount']= count($BlueSC);
                    $GLOBALS['RedSCount']= count($RedSC);
                    $message = $messagesArray[$this->nr];
                    $this->api->chat->broadcast("[ISN] " . 'There are 4 minutes remaining!');
                    if($this->nr < count($messagesArray)-1) {$this->nr++;}
                    $this->timer++;
                break;
            case 4:
                global $BlueSC,$RedSC,$BlueSCount,$RedSCount;
                    $GLOBALS['BlueSCount']= count($BlueSC);
                    $GLOBALS['RedSCount']= count($RedSC);
                    $message = $messagesArray[$this->nr];
                    $this->api->chat->broadcast("[ISN] " . 'There are 2 minutes remaining!');
                    if($this->nr < count($messagesArray)-1) {$this->nr++;}
                    $this->timer++;
                break;
            case 5:
                global $BlueSC,$RedSC,$BlueSCount,$RedSCount;
                    $GLOBALS['BlueSCount']= count($BlueSC);
                    $GLOBALS['RedSCount']= count($RedSC);
                    $message = $messagesArray[$this->nr];
                    $this->api->chat->broadcast("[ISN] " . 'There is 1 minute remaining!');
                    if($this->nr < count($messagesArray)-1) {$this->nr++;}
                    $this->timer++;
                break;
            case 6:
                global $BlueSC,$RedSC,$BlueSCount,$RedSCount;
                    $GLOBALS['BlueSCount']= count($GLOBALS['BlueSC']);
                    $GLOBALS['RedSCount']= count($GLOBALS['RedSC']);
                        if($GLOBALS['RedSCount'] > $GLOBALS['BlueSCount']){$winners = 'The Red Team have won !!';}
                        if($GLOBALS['RedSCount'] < $GLOBALS['BlueSCount']){$winners = 'The Blue Team have won !!';}
                        if($GLOBALS['RedSCount'] === $GLOBALS['BlueSCount']){$winners = 'Ah Really Guys, a DRAW ?!!';}
                            $message = $messagesArray[$this->nr];
                            $this->api->chat->broadcast("[ISN] " . $winners );
                            $this->api->chat->broadcast("[ISN] " . 'Match Finished Thanks for Playing!');
                            if($this->nr < count($messagesArray)-1) {$this->nr++;}
                            
                            $this->api->console->run("stop");
                }
            }
         
    public function eventHandler($data, $event) {
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
                            $player->setSpawn(new Vector3(127, 68, 156));
                            $player->teleport(new Vector3(127, 68, 156));
                            $player->setArmor(0, BlockAPI::getItem(LEATHER_CAP, 0, 0));
                            $player->setArmor(2, BlockAPI::getItem(LEATHER_PANTS, 0, 0));
                            $username->sendChat('You are now a member of team Red !');
                        }
                        if ($RedCount >= $BlueCount){
                        array_push($GLOBALS['Blue'],$username);
                            $player->setSpawn(new Vector3(126, 68, 93));
                            $player->teleport(new Vector3(126, 68, 93));
                            $player->setArmor(0, BlockAPI::getItem(DIAMOND_HELMET, 0, 0));
                            $username->sendChat('You are now a member of team Blue !');
                        }
                           
                        foreach($this->items as $id => $count){
                            $player->addItem((int)$id, 0, (int)$count);}
                            $player->setArmor(1, BlockAPI::getItem(CHAIN_CHESTPLATE, 0, 0));
                        break;
               
                        case "player.armor":
                        $username = $data["player"]->username;
                        $player = $data["player"];
                        if ($data["slot0"] === 255){
                            $search = array_search($GLOBALS['username'],$GLOBALS['Blue']);
                            if ($search !== FALSE){
                                $player->setArmor(0, BlockAPI::getItem(DIAMOND_HELMET, 0, 0));
                                $this->api->console->run("spawnpoint $username 126 68 93");
                                }
                                $search2 = array_search($GLOBALS['username'],$GLOBALS['Red']);
                                if ($search2 !== FALSE){
                                    $player->setArmor(0, BlockAPI::getItem(LEATHER_CAP, 0, 0));
                                         
                                }
                        }
                        if ($data["slot1"] === 255){
                                $player->setArmor(1, BlockAPI::getItem(CHAIN_CHESTPLATE, 0, 0));
                        }
                        if ($data["slot2"] === 255){
                                $search2 = array_search($GLOBALS['username'],$GLOBALS['Red']);
                                if ($search2 !== FALSE){
                                    $player->setArmor(2, BlockAPI::getItem(LEATHER_PANTS, 0, 0));
                                }}
                                break;
               
                        case "player.quit":
                            global $Red,$Blue,$BlueCount,$RedCount;
                            $GLOBALS['username']= $this->api->player->get($data->iusername);
                            
                        $search = array_search($username,$Blue);
                        if ($search !== FALSE){
                        $Blue = str_replace($username,'',$Blue);
                        $GLOBALS['Blue'] = array_filter($Blue);}

                        $search = array_search($username,$Red);
                        if ($search !== FALSE){
                        $Red = str_replace($username,'',$Red);
                        $GLOBALS['Red'] = array_filter($Red);}
                        break;
               
                         case "player.drop":
                                 return false;
                                 break;
           
                        case 'player.death':
                            global $Red,$Blue,$BlueCount,$RedCount;
                            $GLOBALS['username']= $this->api->player->get($data->iusername);
                            
                        $searchB = array_search($username,$Blue);
                        if ($searchB !== FALSE){  array_push($GLOBALS['BlueSC'],$username);
                            $this->api->chat->broadcast("[ISN] " . 'Red Team Score = ' . $GLOBALS['RedSCount']);
                            $this->api->chat->broadcast("[ISN] " . 'Blue Team Score = ' . $GLOBALS['BlueSCount']);}
                            
                        $searchR = array_search($username,$Red);
                        if ($searchR !== FALSE){ array_push($GLOBALS['RedSC'],$username);
                            $this->api->chat->broadcast("[ISN] " . 'Red Team Score = ' . $GLOBALS['RedSCount']);
                            $this->api->chat->broadcast("[ISN] " . 'Blue Team Score = ' . $GLOBALS['BlueSCount']);}
                        break;
     
                        case "player.interact":
                           global $Red,$Blue,$BlueCount,$RedCount;
                       
     
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
