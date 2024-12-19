<?php

namespace HomeSystem\Commandes;

use HomeSystem\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class DelHomeCommand extends Command {

    private Main $plugin;

    public function __construct(Main $plugin)
    {
        parent::__construct("delhome", "Supprimer un home", null, ["delhome"]);
        $this->setPermission("homesystem.command.delhome");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): void {
        if (!$sender instanceof Player) {
            $sender->sendMessage($this->plugin->getConfigManager()->getMessage("command_in_game_only"));
            return;
        }

        if (empty($args[0])) {
            $sender->sendMessage($this->plugin->getConfigManager()->getMessage("home_usage_delhome"));
            return;
        }

        $homeName = $args[0];
        if ($this->plugin->getHomeManager()->deleteHome($sender->getName(), $homeName)) {
            $sender->sendMessage($this->plugin->getConfigManager()->getMessage("home_deleted"));
        } else {
            $sender->sendMessage($this->plugin->getConfigManager()->getMessage("home_not_set"));
        }
    }
}
