<?php

namespace Nathan;

use Nathan\Events\Players\JoinEvent;
use Nathan\Events\Players\QuitEvent;
use Nathan\Scoreboard\Scoreboard;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

/**
 * Class Main
 * @package Nathan
 */
class Main extends PluginBase
{
    public $game = 'inDefintion';
    public $scoreboards = null;
    public $minutes = 0;
    public $seconds = 0;
    public $pvpActivation;
    public $meetupActivation;
    /**
     * @var Main
     */
    private static $main;

    public function onEnable()
    {
        /// LOG ///
        $this->getLogger()->info(TextFormat::GREEN . "plugin loaded");
        $this->getLogger()->info('' . PHP_EOL .
            TextFormat::GREEN . '   WEBSITE : ' . TextFormat::WHITE . 'https://github.com/Nahan459770       ' . PHP_EOL .
            TextFormat::AQUA . "DISCORD : " . TextFormat::WHITE . "[ Nathan ]#6078" . PHP_EOL);

        /// CONFIGS ///
        if (!file_exists($this->getDataFolder() . "Config.yml")) {
            $this->saveResource("Config.yml");
        }
        @mkdir($this->getDataFolder() . 'players/');

        $event = $this->getServer()->getPluginManager();
        $event->registerEvents(new QuitEvent(), $this);
        $event->registerEvents(new JoinEvent(), $this);
    }
    public function onLoad()
    {
        self::$main = $this;
    }

    public static function getInstance() : Main
    {
        return self::$main;
    }

    public function getScoreboard(): Scoreboard
    {
        return $this->scoreboards;
    }
}