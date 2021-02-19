<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 *
 *
*/

declare(strict_types=1);

namespace Nathan\Blocks;

use Nathan\Main;
use pocketmine\block\BlockToolType;
use pocketmine\block\Solid;
use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\item\TieredTool;

class IronOre extends Solid{

    protected $id = self::IRON_ORE;

    public function __construct(int $meta = 0)
    {
        $this->meta = $meta;
    }

    public function getName() : string{
        return "Iron Ore";
    }

    public function getToolType() : int{
        return BlockToolType::TYPE_PICKAXE;
    }

    public function getToolHarvestLevel() : int{
        return TieredTool::TIER_STONE;
    }

    public function getHardness() : float{
        return 3;
    }

    public function getDropsForCompatibleTool(Item $item) : array{
        if(Main::getInstance()->scenarios['cutclean'] == "§aenabled") {
            return [
                ItemFactory::get(Item::IRON_INGOT)
            ];
        }
        return [
            ItemFactory::get(Item::IRON_ORE)
        ];
    }

    protected function getXpDropAmount() : int{
        if(Main::getInstance()->scenarios['cutclean'] == "§aenabled") {
            return 2;
        }
        return 0;
    }
}
