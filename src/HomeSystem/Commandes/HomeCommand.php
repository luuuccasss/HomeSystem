<?php

namespace HomeSystem\Commandes;

use HomeSystem\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\world\Position;

class HomeCommand extends Command {

    private Main $plugin;

    public function __construct(Main $plugin)
    {
        parent::__construct("home", "Se téléporter à un home ou afficher la liste des homes", null, ["home"]);
        $this->setPermission("homesystem.command.home");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): void {
        if (!$sender instanceof Player) {
            $sender->sendMessage($this->plugin->getConfigManager()->getMessage("command_in_game_only"));
            return;
        }

        if (empty($args)) {
            $homes = $this->plugin->getHomeManager()->getAllHomes($sender->getName());
            if (empty($homes)) {
                $sender->sendMessage($this->plugin->getConfigManager()->getMessage("home_not_set"));
                return;
            }

            $homeList = implode(", ", array_keys($homes));
            $sender->sendMessage($this->plugin->getConfigManager()->getMessage("homes_list_prefix") . $homeList);
            return;
        }

        $homeName = $args[0];
        $home = $this->plugin->getHomeManager()->getHome($sender->getName(), $homeName);

        if ($home === null) {
            $sender->sendMessage($this->plugin->getConfigManager()->getMessage("home_not_set"));
            return;
        }

        $world = $this->plugin->getServer()->getWorldManager()->getWorldByName($home["world"]);
        if ($world === null) {
            $sender->sendMessage($this->plugin->getConfigManager()->getMessage("home_world_missing"));
            return;
        }

        $position = new Position($home["x"], $home["y"], $home["z"], $world);
        $sender->teleport($position);

        $sender->sendMessage($this->plugin->getConfigManager()->getMessage("home_teleport_success"));
    }
}
