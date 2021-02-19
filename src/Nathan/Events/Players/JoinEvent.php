<?php

namespace Nathan\Events\Players;

use Nathan\API\UHC\API;
use Nathan\Main;
use Nathan\Scoreboard\Scoreboard;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\utils\Config;
use function file_exists;

/**
 * Class JoinEvent
 * @package Nathan\Events\Players
 */
class JoinEvent implements Listener
{
    /**
     * @param PlayerJoinEvent $ev
     */
    public function onJoin(PlayerJoinEvent $ev)
    {
        $player = $ev->getPlayer();
        if(!file_exists(Main::getInstance()->getDataFolder() . 'players/' . strtolower($player->getName()) . '.yml')){
            API::createAccount($player);
            Main::getInstance()->saveResource(Main::getInstance()->getDataFolder() . 'players/' . strtolower($player->getName()) . '.yml', Config::YAML);
        }
        $config = new Config(Main::getInstance()->getDataFolder() . 'players/' . strtolower($player->getName()) . '.yml', Config::YAML);
        $ev->setJoinMessage('§7[§a+§7] §a' . $player->getName() . ' §8(' . API::getOnlinePlayers() . ')');
        Main::getInstance()->scoreboards = new Scoreboard($player, $player->getName(), '§l§bUHC');
        switch (Main::getInstance()->game){
            case 'inProgress':
                if($config->get('statut') === 'disconnected'){
                    $config->set('statut', 'alive');
                }else{
                    $config->set('statut', 'spectator');
                }
                break;

            case 'inDefinition':
                $config->set('statut', 'pending');
                break;

            case 'Finished':
                $config->set('statut', 'spectator');
                break;
        }
        $config->save();
        API::setInventory($player);
    }
}
