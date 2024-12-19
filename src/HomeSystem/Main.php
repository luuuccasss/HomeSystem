<?php

namespace HomeSystem;

use pocketmine\plugin\PluginBase;
use HomeSystem\Utils\ConfigManager;
use HomeSystem\Utils\Manager;
use HomeSystem\Commandes\HomeCommand;
use HomeSystem\Commandes\SetHomeCommand;
use HomeSystem\Commandes\DelHomeCommand;

class Main extends PluginBase {

    private Manager $homeManager;

    private ConfigManager $configManager;

    public function onEnable(): void {
        $this->saveResource("config.yml");
        $this->configManager = new ConfigManager($this->getDataFolder());
        $this->homeManager = new Manager($this->getDataFolder());
        $this->getServer()->getCommandMap()->register("sethome", new SetHomeCommand($this), "sethome");
        $this->getServer()->getCommandMap()->register("home", new HomeCommand($this), "home");
        $this->getServer()->getCommandMap()->register("delhome", new DelHomeCommand($this), "delhome");
        $this->getLogger()->info("HomeSystem enabled! Join our Discord for support: https://discord.gg/33PskyeFh3");
    }

    public function onDisable(): void {
        $this->getLogger()->info("HomeSystem disabled! Join our Discord for support: https://discord.gg/33PskyeFh3");
    }

    public function getHomeManager(): Manager {
        return $this->homeManager;
    }
    public function getConfigManager(): ConfigManager {
        return $this->configManager;
    }
}
