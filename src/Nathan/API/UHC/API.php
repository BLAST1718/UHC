<?php

namespace Nathan\API\UHC;

use Nathan\Main;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\utils\Config;

/**
 * Class API
 * @package Nathan\API\UHC
 */
class API
{
    /**
     * @return int
     */
    public static function getOnlinePlayers() : int
    {
        $nbr = 0;
        foreach (Main::getInstance()->getServer()->getOnlinePlayers() as $p){
            $nbr++;
        }
        return $nbr;
    }

    /**
     * @return int
     */
    public static function getPlayersAlive() : int
    {
        $alive = 0;
        foreach (Main::getInstance()->getServer()->getOnlinePlayers() as $p){
            $config = new Config(Main::getInstance()->getDataFolder() . 'players/' . strtolower($p->getName()) . '.yml', Config::YAML);
            if($config->get('statut') === 'alive'){
                $alive++;
            }
        }
        return $alive;
    }

    /**
     * @param Player $player
     */
    public static function createAccount(Player $player)
    {
        $config = new Config(Main::getInstance()->getDataFolder() . 'players/' . strtolower($player->getName()) . '.yml', Config::YAML);
        $config->set('statut', 'spec');
        $config->save();
    }

    /**
     * @param Player $player
     * @return bool
     */
    public static function setInventory(Player $player) : bool
    {
        $config = new Config(Main::getInstance()->getDataFolder() . 'players/' . strtolower($player->getName()) . '.yml', Config::YAML);
        switch ($config->get('statut')){

            case 'spectator':
                $player->getInventory()->clearAll();
                $player->getArmorInventory()->clearAll();
                $player->getInventory()->setContents([4 => Item::get(Item::ENDER_EYE)]);
                $player->sendMessage('§6You are now in spectator mode !');
                return true;

            case 'pending':
                $player->getInventory()->clearAll();
                $player->getArmorInventory()->clearAll();
                if($player->hasPermission('uhc.host')){
                    $player->getInventory()->setContents([3 => Item::get(Item::BOOK)->setCustomName('§6Rules'), 4 => Item::get(Item::WALL_BANNER)->setCustomName('§6Teams'), 5=> Item::get(Item::MINECART_WITH_CHEST)->setCustomName('§6Host')]);
                }else{
                    $player->getInventory()->setContents([0 => Item::get(Item::BOOK)->setCustomName('§6Rules'), 4 => Item::get(Item::WALL_BANNER)->setCustomName('§6Teams')]);
                }
                return true;

        }
        return true;
    }
}