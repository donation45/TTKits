<?php

namespace TT\TTKits;

use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;
use pocketmine\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\entity\Effect;
use pocketmine\item\Item;

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
                 if(isset($args[0]) && $sender instanceof Player) {
                    $kit = strtolower($args[0]);
                    switch($kit) {
                    case "assassin":
                        $sender->sendMessage(TextFormat::GREEN . "You have chosen the Assassin kit.");
                        $sender->getInventory()->clearAll();
                        $sender->getInventory()->setHelmet(Item::get(298));
                        $sender->getInventory()->setChestplate(Item::get(299));
                        $sender->getInventory()->setLeggings(Item::get(316));
                        $sender->getInventory()->setBoots(Item::get(301));
                        $sender->getInventory()->sendArmorContents($sender);
                        $sword = Item::fromString("iron_sword");
                        $sword->setCount(1);
                        $sender->getInventory()->addItem($sword);
                        // Will need to set identifier soon.
                        break;
                    case "tank":
                        $sender->sendMessage(TextFormat::GREEN . "You have chosen the Tank kit.");
                        $sender->getInventory()->clearAll();
                        $sender->getInventory()->setHelmet(Item::get(306));
                        $sender->getInventory()->setChestplate(Item::get(303));
                        $sender->getInventory()->setLeggings(Item::get(304));
                        $sender->getInventory()->setBoots(Item::get(309));
                        $sender->getInventory()->sendArmorContents($sender);
                        $sword = Item::fromString("wooden_sword");
                        $sword->setCount(1);
                        $sender->getInventory()->addItem($sword);
                        // Will need to set identifier soon.
                        break;
                    case "spectre":
                        $sender->sendMessage(TextFormat::GREEN . "You have chosen the Spectre kit.");
                        $sender->getInventory()->clearAll();
                        $sender->getInventory()->setBoots(Item::get(305));
                        $sender->getInventory()->sendArmorContents($sender);
                        $axe = Item::fromString("stone_axe");
                        $axe->setCount(1);
                        $sender->getInventory()->addItem($axe);
                        $sugar = Item::fromString("sugar");
                        $sugar->setCount(1);
                        $sender->getInventory()->addItem($sugar);
                        // Will need to set identifier soon.
                        break;
                    default:
                        $sender->sendMessage($cmd->getUsage);
                        return;
                    }
                 }
                 else
                 {
                       $sender->sendMessage($cmd->getUsage);
                       return;
                 }   
            break;
        }
    }
}
