<?php

namespace Nathan\Forms;

use Nathan\API\jojoe77777\CustomForm;
use Nathan\Main;
use pocketmine\Player;
use pocketmine\utils\Config;

/**
 * Class rules
 * @package Nathan\Forms
 */
class rules
{
    /**
     * @param Player $player
     * @return bool
     */
    public static function form(Player $player) : bool
    {
        $form = new CustomForm(function (Player $player, $data){
           if($data === null) return true;
        });
        $form->setTitle('§7-§c Rules §7-');
        $config = new Config(Main::getInstance()->getDataFolder() . 'Config.yml', Config::YAML);
        $form->addLabel($config->get('rules'));
        $form->sendToPlayer($player);
        return true;
    }
}
