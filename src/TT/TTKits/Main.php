<?php

namespace TT\TTKits;

use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;
use pocketmine\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class Main extends PluginBase implements Listener{

     public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info(TextFormat::GREEN . "TTKits enabled!");
     }
     public function onDisable(){
        $this->getLogger()->info(TextFormat::RED . "TTKits disabled!");
     }
     public function onCommand(CommandSender $sender, Command $cmd, $label,array $args){
        switch(strtolower($cmd->getName())){
        case "kit":
                 if($sender instanceof Player and $args[1] == "assassin"){
                    $sender->sendMessage(TextFormat::GREEN . "You have chosen the Assassin kit.");
                    $sender->getInventory->setHelmet(Item::get(298));
                    $sender->getInventory->setChestplate(Item::get(299));
                    $sender->getInventory->setLeggings(Item::get(316));
                    $sender->getInventory->setBoots(Item::get(301));
                    $sender->getInventory->sendArmorContents($sender
// unfinished line above, have to go somewhere
                 }
                 else
                 {
                       $sender->sendMessage($cmd->getUsage);
                 }   
        return true;
        }
    }
}
