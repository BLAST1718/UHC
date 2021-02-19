<?php

namespace Nathan\Events\Players;

use Nathan\Forms\rules;
use Nathan\Main;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\item\Item;
use pocketmine\utils\Config;

/**
 * Class InteractEvent
 * @package Nathan\Events\Players
 */
class InteractEvent implements Listener
{
    /**
     * @param PlayerInteractEvent $ev
     */
    public function onInteract(PlayerInteractEvent $ev)
    {

        $id = $ev->getItem()->getId();
        $player = $ev->getPlayer();
        $config = new Config(Main::getInstance()->getDataFolder() . 'players/' . strtolower($player->getName()) . '.yml', Config::YAML);
        if($ev->getAction() === PlayerInteractEvent::RIGHT_CLICK_AIR) {
            switch ($id) {
                case 340:       /// BOOK ///
                    if($config->get('statut') === 'pending'){
                        rules::form($player);
                    }
                    break;
            }
        }
    }
}