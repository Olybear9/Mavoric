<?php
/***
 *      __  __                       _      
 *     |  \/  |                     (_)     
 *     | \  / | __ ___   _____  _ __ _  ___ 
 *     | |\/| |/ _` \ \ / / _ \| '__| |/ __|
 *     | |  | | (_| |\ V / (_) | |  | | (__ 
 *     |_|  |_|\__,_| \_/ \___/|_|  |_|\___|
 *                                          
 *   THIS CODE IS TO NOT BE REDISTRUBUTED
 *   @author MavoricAC
 *   @copyright Everything is copyrighted to their respective owners.
 *   @link https://github.com/Olybear9/Mavoric                                  
 */

namespace Bavfalcon9\Mavoric\events;

use pocketmine\Player;
use Bavfalcon9\Mavoric\Mavoric;
use Bavfalcon9\Mavoric\misc\Flag;

class MavoricEvent {
    public const PLAYER_ATTACK = 1;
    public const PLAYER_BREAK_BLOCK = 2;
    public const PLAYER_MOVE = 3;
    public const PLAYER_TELEPORT = 4;
    public const PLAYER_USE_ITEM = 5;
    public const PLAYRE_INTERACTION = 6;
    public const PLAYER_CONSUME = 7;

    private $mavoric;
    private $type;
    private $eventData;
    private $player;
    private $isCancelled = false;
    private $isCheating = false;

    public function __construct(Mavoric $mavoric, int $eventType, Player $player, $event) {
        $this->mavoric = $mavoric;
        $this->type = $eventType;
        $this->eventData = $event;
        $this->player = $player;
    }

    public function cancel(Bool $val=true): Bool {
        $this->eventData->setCancelled($val);
        $this->isCancelled = $val;
        return $val;
    }

    public function getType(): int {
        return $this->type;
    }

    public function getPMEvent() {
        return $this->eventData;
    }

    public function getPlayer(): ?Player {
        return $this->player;
    }

    public function setCheating(Bool $val): Bool {
        $this->isCheating = $val;
        return $val;
    }

    public function getCheating(): Bool {
        return $this->isCheating;
    }

    public function issueViolation(int $cheat): Flag {
        $flag = $this->mavoric->getFlag($this->player);
        $flag->addViolation($cheat, 1);
        return $flag;
    }

    
}