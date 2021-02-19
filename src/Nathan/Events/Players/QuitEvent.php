<?php

namespace Nathan\Events\Players;

use Nathan\API\UHC\API;
use Nathan\Main;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\utils\Config;

/**
 * Class QuitEvent
 * @package Nathan\Events\Players
 */
class QuitEvent implements Listener
{
    /**
     * @param PlayerQuitEvent $ev
     */
    public function onQuit(PlayerQuitEvent $ev)
    {
        $player = $ev->getPlayer();
        $ev->setQuitMessage('§7[§c-§7] §c' . $player->getName() . ' §8(' . API::getOnlinePlayers() . ')');
        $config = new Config(Main::getInstance()->getDataFolder() . 'players/' . strtolower($player->getName()) . '.yml', Config::YAML);
        if($config->get('statut') === 'alive'){
            $config->set('statut','disconnected');
        }
    }
}