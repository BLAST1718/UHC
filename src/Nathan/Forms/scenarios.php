<?php

namespace Nathan\Forms;

use Nathan\API\jojoe77777\SimpleForm;
use Nathan\Main;
use pocketmine\Player;

/**
 * Class scenarios
 * @package Nathan\Forms
 */
class scenarios
{
    /**
     * @param Player $player
     * @return bool
     */
    public static function form(Player $player) : bool
    {
        $form = new SimpleForm(function (Player $player, $data){
            if($data === null) return true;

            switch ($data){
                case 0:
                    if(Main::getInstance()->scenarios['cutclean'] === '§cdisabled'){
                        Main::getInstance()->scenarios['cutclean'] === '§aenabled';
                        return true;
                    }
                    Main::getInstance()->scenarios['cutclean'] === '§cdisabled';;
                    return true;


                case 19:
                    rules::form($player);
                    return true;
            }
            self::form($player);
        });
        $scenarios = Main::getInstance()->scenarios;
        $form->setTitle('§7- §cScenarios§7 -');
        $form->setContent('§8>> §eSelect the scenarios for your game : ');
        $form->addButton("§6Cut Clean\n" . $scenarios['cutclean']);
        $form->addButton("§6Hastey Boys\n" . $scenarios['hasteyboys']);
        $form->addButton("§6Blood Diamond\n" . $scenarios['blooddiamond']);
        $form->addButton("§6No Clean Up\n" . $scenarios['nocleanup']);
        $form->addButton("§6No Fire\n" . $scenarios['nofall']);
        $form->addButton("§6No Fall\n" . $scenarios['nofall']);
        $form->addButton("§6No Bow\n" . $scenarios['nobow']);
        $form->addButton("§6Bleeding Sweets\n" . $scenarios['bleedingsweets']);
        $form->addButton("§6Final Heal\n" . $scenarios['finalheal']);
        $form->addButton("§6Cat Eyes\n" . $scenarios['cateyes']);
        $form->addButton("§6Double Health" . $scenarios['doublehealth']);
        $form->addButton("§6Super Heroes\n" . $scenarios['superheroes']);
        $form->addButton("§6Vanilla +\n" . $scenarios['vanilla+']);
        $form->addButton("§6Timber\n" . $scenarios['timber']);
        $form->addButton("§6Time Bomb\n" . $scenarios['timebomb']);
        $form->addButton("§6Assault And Batteries\n" . $scenarios['assaultandbatteries']);
        $form->addButton("§6BookCeption\n" . $scenarios['bookception']);
        $form->addButton("§6No Abso\n" . $scenarios['noabso']);
        $form->addButton("§6Golden Head\n" . $scenarios['goldenhead']);
        $form->addButton('§8Back');
        $form->sendToPlayer($player);
        return true;
    }
}
