<?php

namespace Nathan\API\UHC;

use Nathan\Main;
use pocketmine\event\player\PlayerQuitEvent;
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
}