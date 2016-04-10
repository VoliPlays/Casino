<?php

namespace Casino;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\math\Vector3;
use pocketmine\level\Position;
use pocketmine\utils\TextFormat;
use pocketmine\entity\Entity;
use pocketmine\utils\Config;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerRespawnEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\tile\Sign;
use pocketmine\event\block\SignChangeEvent;
use pocketmine\item\Item;
use pocketmine\Server;
use onebone\economyapi\EconomyAPI;
use pocketmine\Player;

class Main extends PluginBase Implements Listener {
	
	public function onEnable(){
		$this->saveDefaultConfig();
 		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger(TextFormat::GREEN."[Casino] Enabled by TutoGamerWalid v1.0 !");
	     $this->getLogger()->info("===== Copyright 2016 - 2017 © ======");
		$this->getLogger()->info("======== License  ==========");
		$this->api = EconomyAPI::getInstance();
	}
	
	 public function SignChange(SignChangeEvent $event) {
        if($event->getBlock()->getId() == 68 || $event->getBlock()->getId() == 63){ 
		$sign = $event->getPlayer()->getLevel()->getTile($event->getBlock());
		   $money = $this->getConfig()->get("money_of_sign");
	                if ($event->getLine(0) == "[Casino]" && $event->getPlayer()->isOp()){	
                            $event->setLine(0,"[Casino]");
                              $event->getLine(1);
                              $event->getLine(1);
                              $event->getLine(2);
                              $event->setLine(1,"§l§bPlay !");
                              $event->setLine(2,"§l§a++ {$money}$ ++");
                                $player = $event->getPlayer();
                           $player->sendMessage("[Casino] Succefully created !");
                           //create a new sign 
	            }
	       }
	}
	
		public function onPlayerTouch(PlayerInteractEvent $event){
              if($event->getBlock()->getId() == 68 || $event->getBlock()->getId() == 63){ 
	           $sign = $event->getPlayer()->getLevel()->getTile($event->getBlock()); 
	          	if($sign instanceof Sign){
			       $signtext = $sign->getText();
			        $signcustom = $this->getConfig()->get("custom_sign");
			        $money = $this->getConfig()->get("money_of_sign");
                        if($signtext[0] == "[Casino]"){
	                    $player = $event->getPlayer();
	                     $mymoney = $this->api->myMoney($player->getName());                
					              if($money > $mymoney){						
						}else{
					           $this->api->reduceMoney($player, $money); 
	       	           $wl = mt_rand(1, 5);
				
	                     if($wl == 1){
		                 $this->getServer()->broadcastPopup(TextFormat::RED."§l[Casino] {$player->getName()} lose casino try again !");      
	                    }
	                     if($wl == 2){
		                 $winner = $this->getConfig()->get("money_of_win");
		                  $this->api->addMoney($player, $winner);
		                  $this->getServer()->broadcastPopup(TextFormat::GREEN."§l[Casino] {$player->getName()} has won the casino !");
		              }
		              if($wl == 3){
			           $winnerx2 = $this->getConfig()->get("money_of_winx2");
			           $this->api->addMoney($player, $winnerx2);
		                  $this->getServer()->broadcastPopup(TextFormat::GREEN."§l[Casino] {$player->getName()} has won the casino x2 !");
		              }
	                   if($wl == 4){
	                    $this->getServer()->broadcastPopup(TextFormat::RED."§l[Casino] {$player->getName()} lose casino try again !");
	                   }
	                   if($wl == 5){
	                    $this->getServer()->broadcastPopup(TextFormat::RED."§l[Casino] {$player->getName()} lose casino try again !");		     
	                }
	            }
	        }
	    }
	}
  }
}