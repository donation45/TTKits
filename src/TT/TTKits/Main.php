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
// EVENTS
use pocketmine\event\player\PlayerQuitEvent;

class Main extends PluginBase implements Listener{
    
    private $players = array();

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
                        $this->setKit($sender, 1);
                        break;
                    case "tank":
                        $this->setKit($sender, 2);
                        break;
                    case "spectre":
                        $this->setKit($sender, 3);
                        break;
                    default:
                        $sender->sendMessage($this->colorize($cmd->getUsage));
                        return;
                    }
                 }
                 else
                 {
                       $sender->sendMessage($this->colorize($cmd->getUsage));
                       return;
                 }   
            break;
        }
    }
    
    /*
         ___      .______    __  
        /   \     |   _  \  |  | 
       /  ^  \    |  |_)  | |  | 
      /  /_\  \   |   ___/  |  | 
     /  _____  \  |  |      |  | 
    /__/     \__\ | _|      |__| 
     */
    
    /**
     * Adds a player from kit mode. Ex: Player runs /kit
     * 
     * @param Player $player Player that will be removed kit mode.
     * @param int $id Kit ID, see cheatsheat!
     * @return boolean If false, player is not in kit mode.
     */
    public function setKit(Player $player, $id = 0) {
        $player_name = $player->getName();
        $player->getInventory()->clearAll();
        switch($id) {
            case 0:
                $player->sendMessage($this->colorize("&cKit Removed!"));
                $this->players[$player_name] = 0; //Will be unset on death or /leave maybe?
                break;
            case 1:
                $player->sendMessage($this->colorize("&aYou have chosen the &cAssassin&a kit."));
                $player->getInventory()->setHelmet(Item::get(298));
                $player->getInventory()->setChestplate(Item::get(299));
                $player->getInventory()->setLeggings(Item::get(316));
                $player->getInventory()->setBoots(Item::get(301));
                $player->getInventory()->sendArmorContents($player);
                $sword = Item::fromString("iron_sword");
                $sword->setCount(1);
                $player->getInventory()->addItem($sword);
                $this->players[$player_name] = 1; //Will be unset on death or /leave maybe?
                break;
            case 2:
                $player->sendMessage($this->colorize("&aYou have chosen the &9Tank&a kit."));
                $player->getInventory()->setHelmet(Item::get(306));
                $player->getInventory()->setChestplate(Item::get(303));
                $player->getInventory()->setLeggings(Item::get(304));
                $player->getInventory()->setBoots(Item::get(309));
                $player->getInventory()->sendArmorContents($player);
                $sword = Item::fromString("wooden_sword");
                $sword->setCount(1);
                $player->getInventory()->addItem($sword);
                $this->players[$player_name] = 2; //Will be unset on death or /leave maybe?
                break;
            case 3:
                $player->sendMessage($this->colorize("&aYou have chosen the &8Spectre&a kit."));
                $player->getInventory()->setBoots(Item::get(305));
                $player->getInventory()->sendArmorContents($sender);
                $axe = Item::fromString("stone_axe");
                $axe->setCount(1);
                $player->getInventory()->addItem($axe);
                $sugar = Item::fromString("sugar");
                $sugar->setCount(1);
                $player->getInventory()->addItem($sugar);
                $this->players[$player_name] = 3; //Will be unset on death or /leave maybe?
                break;
        }
    }
    
    
    /**
     * Removes a player from kit mode. Ex: Player leaves
     * 
     * @param Player $player Player that will be removed kit mode.
     * @return boolean If false, player is not in kit mode.
     */
    public function removePlayer(Player $player) {
        $player_name = $player->getName();
        if(isset($this->players[$player_name])) {
            unset($this->players[$player_name]);
            $player->getInventory()->clearAll();
            return;
        } else {
            return false;
        }
    }
    /**
     * Will be used to color our messages.
     * This makes it easier and allows us to make the messages beautiful!
     * 
     * @param string $str The string must contain '&' for this function to do anything!
     * @return string Returns the string with '§' instead of '&'.
     */
    public function colorize($str) {
        $new_str = str_replace("&", "§", $str);
        return $new_str;
    }
    
    /* 
     ___________    ____  _______ .__   __. .___________.    _______.
    |   ____\   \  /   / |   ____||  \ |  | |           |   /       |
    |  |__   \   \/   /  |  |__   |   \|  | `---|  |----`  |   (----`
    |   __|   \      /   |   __|  |  . `  |     |  |        \   \    
    |  |____   \    /    |  |____ |  |\   |     |  |    .----)   |   
    |_______|   \__/     |_______||__| \__|     |__|    |_______/   
     */
    
    public function onQuit(PlayerQuitEvent $event) {
        $player = $event->getPlayer();
        $this->removePlayer($player);
    }
}
