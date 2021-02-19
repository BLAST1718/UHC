<?php

namespace Nathan\Events;

use Nathan\Main;
use pocketmine\event\inventory\CraftItemEvent;
use pocketmine\event\Listener;

/**
 * Class CraftEvent
 * @package Nathan\Events
 */
class CraftEvent implements Listener
{
    /**
     * @param CraftItemEvent $ev
     */
    public function onCraft(CraftItemEvent $ev)
    {
        $items = $ev->getOutputs();
        $player = $ev->getPlayer();
        var_dump($items);
    }
}
