<?php

namespace Nathan\Events\Players;

use Nathan\API\UHC\API;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerQuitEvent;

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
    }
}