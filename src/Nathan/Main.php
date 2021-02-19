<?php

namespace Nathan;

use Nathan\Events\CraftEvent;
use Nathan\Events\Players\InteractEvent;
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
    /// SCENARIOS ///
    public $scenarios = [
        'cutclean' => '§cdisabled',
        'hasteyboys' => '§cdisabled',
        'blooddiamond' => '§cdisabled',
        'nocleanup' => '§cdisabled',
        'nofire' => '§cdisabled',
        'nofall' => '§cdisabled',
        'nobow' => '§cdisabled',
        'bleedingsweets' => '§cdisabled',
        'finalheal' => '§cdisabled',
        'cateyes' => '§cdisabled',
        'doublehealth' => '§cdisabled',
        'superheroes' => '§cdisabled',
        'vanilla+' => '§cdisabled',
        'timber' => '§cdisabled',
        'timebomb' => '§cdisabled',
        'assaultandbatteries' => '§cdisabled',
        'bookception' => '§cdisabled',
        'noabso' => '§cdisabled',
        'goldenhead' => '§cdisabled',
    ];

    /// GAME ///
    public $game = 'inDefinition';
    public $scoreboards = null;
    public $minutes = 0;
    public $seconds = 0;
    public $pvpActivation;
    public $meetupActivation;

    /** @var Main */
    private static $main;

    public function onEnable()
    {
        /// LOG ///
        $this->getLogger()->info(TextFormat::GREEN . "plugin loaded");
        $this->getLogger()->info('' . PHP_EOL .
            TextFormat::GREEN . 'WEBSITE : ' . TextFormat::WHITE . 'https://github.com/Nahan459770       ' . PHP_EOL .
            TextFormat::AQUA . "DISCORD : " . TextFormat::WHITE . "[ Nathan ]#6078" . PHP_EOL);

        /// CONFIGS ///
        if (!file_exists($this->getDataFolder() . "Config.yml")) {
            $this->saveResource("Config.yml");
        }
        @mkdir($this->getDataFolder() . 'players/');

        /// EVENTS ///
        $event = $this->getServer()->getPluginManager();
        $event->registerEvents(new QuitEvent(), $this);
        $event->registerEvents(new JoinEvent(), $this);
        $event->registerEvents(new InteractEvent(), $this);
        $event->registerEvents(new CraftEvent(), $this);
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