<?php

/*
__PocketMine Plugin__
name=PMTouchBlock
description=Tap a specific block to receive PM !
version=1.0
author=A9_0Z
class=PMTouchBlock
apiversion=9
*/

/* 
Small Changelog
===============
1.0: Initial release
*/

class PMTouchBlock implements Plugin{
    private $api;
    public function __construct(ServerAPI $api, $server = false){
        $this->api = $api;
    }
    public function init(){
        $this->api->addHandler("player.block.touch", array($this, "touchHandler"));
		$this->path = $this->api->plugin->configPath($this);
		$this->config = new Config($this->path."config.yml", CONFIG_YAML, array(
			'BlockId' => '246',
			'MsgWhenGiven' => 'You have been awarded 500 PM !',
		));
		$data = array(
			'issuer' => 'MoneySetTo600Plugin',
			'username' => 'MinecrafterJPN',
			'method' => 'set',
			'amount' => 600);
			
			$this->api->dhandle("money.handle", $data);
    }
	
    public function touchHandler($data){
        $target = $data["target"];
        if ($target->getID() === $this->block){
			$username = $data["player"]->username;
			$player = $this->api->player->get($username);
			foreach($this->items as $id => $count){
				$player->addItem((int)$id, 0, (int)$count);
			}
			$this->api->chat->sendTo(false, $this->config->get('MsgWhenGiven'), $username);
        }
    }
	
    public function __destruct(){
	
    }
}
