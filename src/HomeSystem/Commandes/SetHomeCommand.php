<?php

namespace HomeSystem\Commandes;

use HomeSystem\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class SetHomeCommand extends Command {

    private Main $plugin;

    public function __construct(Main $plugin)
    {
        parent::__construct("sethome", "Définir un home", null, ["sethome"]);
        $this->setPermission("homesystem.command.sethome");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): void {
        if (!$sender instanceof Player) {
            $sender->sendMessage($this->plugin->getConfigManager()->getMessage("command_in_game_only"));
            return;
        }

        if (empty($args[0])) {
            $sender->sendMessage($this->plugin->getConfigManager()->getMessage("home_usage_sethome"));
            return;
        }

        $homeName = $args[0];
        $position = $sender->getPosition();
        $homeData = [
            "x" => $position->getX(),
            "y" => $position->getY(),
            "z" => $position->getZ(),
            "world" => $position->getWorld()->getFolderName()
        ];

        if ($this->plugin->getHomeManager()->setHome($sender->getName(), $homeName, $homeData)) {
            $sender->sendMessage($this->plugin->getConfigManager()->getMessage("home_set_success"));
        } else {
            $sender->sendMessage($this->plugin->getConfigManager()->getMessage("home_already_exists"));
        }
    }
}
