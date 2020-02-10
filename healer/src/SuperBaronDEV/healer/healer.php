<?php

namespace SuperBaronDEV\healer;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;

class healer extends PluginBase implements Listener {

    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);    
        $this->getLogger()->info(TextFormat::GREEN . "Plugin Enabled!");
    }
    public function onDisable() {
        $this->getLogger()->info(TextFormat::RED . "Plugin Disabled!");
    }
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
        switch($cmd->getName()){                    
            case "heal":
                if ($sender->hasPermission("heal.use")){
                     $this->Menu($sender);
                }else{     
                     $sender->sendMessage(TextFormat::RED . "You dont have permission!");
                     return true;
                }     
            break;         
            
         }  
        return true;                         
    }
   
    public function Menu($sender){ 
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, int $data = null) { 
            $result = $data;
            if($result === null){
                return true;
            }             
            switch($result){
                case 0:
            $sender->setHealth(20);
            $sender->addTitle("Healed", "You are secfully healed!!!");
            $sender->sendMessage(TextFormat:: GREEN . "§aYou have been healed!");
                break;
                    
                case 1:
                break;
            }
            
            
            });
            $form->setTitle("§lHeal");
            $form->addButton("§a§lHeal");
            $form->addButton("§l§cExit");
            $form->sendToPlayer($sender);
            return $form;                                            
    }
 
                                                                                                                                                                                                                                                                                          
}
