<?php

namespace ClearLag;

use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\ClosureTask;
use pocketmine\Server;
use pocketmine\world\World;
use pocketmine\entity\object\ItemEntity;
use pocketmine\utils\TextFormat;

class Main extends PluginBase {

    private $clearInterval;
    private $clearMessage;
    private $warningMessage;
    private $broadcastInterval;
    private $broadcastMessage;
    private $timeRemaining;

    public function onEnable(): void {
        $this->saveDefaultConfig();
        $this->clearInterval = $this->getConfig()->get("clear-interval", 120);
        $this->clearMessage = $this->getConfig()->get("clear-message", "§aBasura recogida correctamente.");
        $this->warningMessage = $this->getConfig()->get("warning-message", "§cRecogiendo basura en {time}...");
        $this->broadcastInterval = $this->getConfig()->get("broadcast-interval", 15);
        $this->broadcastMessage = $this->getConfig()->get("broadcast-message", "§bLos ítems serán borrados en {time} segundos.");
        $this->timeRemaining = $this->clearInterval;

        $this->getScheduler()->scheduleRepeatingTask(new ClosureTask(function(): void {
            $this->onTick();
        }), 20);

        $this->getScheduler()->scheduleRepeatingTask(new ClosureTask(function(): void {
            $this->broadcastTime();
        }), $this->broadcastInterval * 20);
    }

    private function onTick(): void {
        if ($this->timeRemaining <= 5 && $this->timeRemaining > 0) {
            $this->getServer()->broadcastMessage(str_replace("{time}", (string)$this->timeRemaining, $this->warningMessage));
        }

        if ($this->timeRemaining <= 0) {
            $this->clearItems();
            $this->timeRemaining = $this->clearInterval;
        } else {
            $this->timeRemaining--;
        }
    }

    private function clearItems(): void {
        foreach (Server::getInstance()->getWorldManager()->getWorlds() as $world) {
            foreach ($world->getEntities() as $entity) {
                if ($entity instanceof ItemEntity) {
                    $entity->flagForDespawn();
                }
            }
        }
        $this->getServer()->broadcastMessage($this->clearMessage);
    }

    private function broadcastTime(): void {
        $this->getServer()->broadcastMessage(str_replace("{time}", (string)$this->timeRemaining, $this->broadcastMessage));
    }
}
