<?php

namespace Nathan\Task;

use Nathan\Main;
use pocketmine\scheduler\Task;

class seconds extends Task
{

    public function onRun(int $currentTick)
    {
        /// TIMER ///
        if(Main::getInstance()->game === 'inProgress') {
            Main::getInstance()->seconds++;
            if(Main::getInstance()->seconds === 60){
                Main::getInstance()->seconds = 0;
                Main::getInstance()->minutes++;
            }
        }
    }
}
