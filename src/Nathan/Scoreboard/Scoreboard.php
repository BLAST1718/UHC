<?php

namespace Nathan\Scoreboard;

use Nathan\API\UHC\API;
use Nathan\Main;
use pocketmine\network\mcpe\protocol\RemoveObjectivePacket;
use pocketmine\network\mcpe\protocol\SetDisplayObjectivePacket;
use pocketmine\network\mcpe\protocol\SetScorePacket;
use pocketmine\network\mcpe\protocol\types\ScorePacketEntry;
use pocketmine\Player;

/**
 * Class Scoreboard
 * @package Nathan\Scoreboard
 */
class Scoreboard
{
    /** @var array */
    private $viewers = [];
    public $scoreboard = [];

    /**
     * Scoreboard constructor
     * @param Player $player
     * @param string $objectiveName
     * @param string $displayName
     */

    public function __construct(Player $player, string $objectiveName, string $displayName)
    {
        if(isset($this->scoreboard[$player->getName()])){
            $this->remove($player);
        }

        $pk = new SetDisplayObjectivePacket();
        $pk->displaySlot = "sidebar";
        $pk->objectiveName = $objectiveName;
        $pk->displayName = "§l§bUHC";
        $pk->criteriaName = "dummy";
        $pk->sortOrder = 0;
        $player->sendDataPacket($pk);

        $this->viewers[$player->getName()] = $player;

        $this->scoreboard[$player->getName()] = $objectiveName;
        $this->setEmptyLine($player, 1, "§7------Timer-------");
        $this->setEmptyLine($player, 2, "§c Timer : §6" . Main::getInstance()->minutes .":" . Main::getInstance()->seconds);
        $this->setEmptyLine($player, 3, "§cJoueurs restants : §6" . API::getPlayersAlive());
        $this->setEmptyLine($player, 4, "§7-------Info--------");
        $this->setEmptyLine($player, 5, "§c PVP : §6" . Main::getInstance()->pvpActivation . " minute(s)");
        $this->setEmptyLine($player, 6, "§c Meetup : §6" . Main::getInstance()->meetupActivation . " minute(s)");
    }

    /**
     * @param Player $player
     */

    public function remove(Player $player)
    {
        $pk = new RemoveObjectivePacket();
        $pk->objectiveName = $this->getObjectiveName($player);
        $player->sendDataPacket($pk);
        unset($this->scoreboard[$player->getName()]);
    }

    /**
     * @param Player $player
     * @param int $score
     * @param string $line
     */

    public function setLine(Player $player, int $score, string $line)
    {
        if(!isset($this->scoreboard[$player->getName()]))
        {
            return;
        }

        if($score > 15 or $score < 0)
        {
            return;
        }
        $entry = new ScorePacketEntry();
        $entry->objectiveName = $this->getObjectiveName($player);
        $entry->type = ScorePacketEntry::TYPE_FAKE_PLAYER;
        $entry->customName = $line;
        $entry->score = $score;
        $entry->scoreboardId= $score;
        $pk = new SetScorePacket();
        $pk->type = SetScorePacket::TYPE_CHANGE;
        $pk->entries[] = $entry;
        $player->sendDataPacket($pk);
    }

    /**
     * @param Player $player
     * @param int $line
     * @param string $text
     */

    public function setEmptyLine(Player $player, int $line, string $text)
    {
        $this->setLine($player, $line, $text);
    }

    /**
     * @param Player $player
     * @return string|null
     */

    public function getObjectiveName(Player $player): ?string
    {
        return isset($this->scoreboard[$player->getName()]) ? $this->scoreboard[$player->getName()] : null;
    }

    /**
     * @param Player $player
     * @param string $objectiveName
     * @param string $displayName
     */

    public function update(Player $player, string $objectiveName, string $displayName)
    {
        if(isset($this->scoreboard[$player->getName()])){
            $this->remove($player);
        }

        $pk = new SetDisplayObjectivePacket();
        $pk->displaySlot = "sidebar";
        $pk->objectiveName = $objectiveName;
        $pk->displayName = "§l§bKills";
        $pk->criteriaName = "dummy";
        $pk->sortOrder = 0;
        $player->sendDataPacket($pk);

        $this->scoreboard[$player->getName()] = $objectiveName;
        $this->setEmptyLine($player, 1, "§7------Timer-------");
        $this->setEmptyLine($player, 2, "§c Timer : §6" . Main::getInstance()->minutes .":" . Main::getInstance()->seconds);
        $this->setEmptyLine($player, 3, "§cJoueurs restants : §6" . API::getPlayersAlive());
        $this->setEmptyLine($player, 4, "§7-------Info--------");
        $this->setEmptyLine($player, 5, "§c PVP : §6" . Main::getInstance()->pvpActivation . " minute(s)");
        $this->setEmptyLine($player, 6, "§c Meetup : §6" . Main::getInstance()->meetupActivation . " minute(s)");

    }

    /**
     * @return array
     */

    public function getViewers(): array
    {
        return $this->viewers;
    }
}
