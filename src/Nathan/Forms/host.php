<?php

namespace Nathan\Forms;

use Nathan\API\jojoe77777\SimpleForm;
use Nathan\Main;
use pocketmine\Player;

/**
 * Class host
 * @package Nathan\Forms
 */
class host
{
    /**
     * @param Player $player
     * @return bool
     */
    public static function form(Player $player): bool
    {
        $form = new SimpleForm(function (Player $player, $data){
           if($data === null) return true;

           switch ($data){

               case 0:
                   break;
           }
        });
        $form->setTitle('§7- §cHost§7 -');
        $form->setContent('§eSelect a category : ');
        $form->addButton('§6Scenarios', 0, 'textures/items/diamond.png');
        $form->addButton('§6Customize', 0, 'textures/items/emerald.png');
        $form->addButton('§6Choosing the starter kit', 0, 'textures/items/diamond_sword.png');
        $form->addButton('§6Select my old configuration', 0, 'textures/items/chest.png');
        $form->addButton('§6Save my configuration', 0, 'textures/items/blaze_powder.png');
        $form->addButton('§cStart', 0, 'textures/items/redstone_dust.png');
        $form->sendToPlayer($player);
        return true;
    }
}
