<?php

namespace HomeSystem\utils;

use pocketmine\utils\Config;

class ConfigManager {

    private Config $config;

    public function __construct(string $dataFolder) {
        $configPath = $dataFolder . "config.yml";
        if (!file_exists($configPath)) {
            $defaultConfig = [
                "messages" => [
                    "command_in_game_only" => "§cThis command can only be used in-game.",
                    "home_deleted" => "§aYour home has been successfully deleted.",
                    "home_not_set" => "§cNo home found with this name.",
                    "home_world_missing" => "§cThe world associated with this home does not exist or is not loaded.",
                    "home_teleport_success" => "§aSuccessfully teleported to your home.",
                    "home_set_success" => "§aYour home has been successfully set.",
                    "home_already_exists" => "§cA home with this name already exists.",
                    "home_usage_delhome" => "§cUsage: /delhome <name>",
                    "home_usage_home" => "§cUsage: /home [name]",
                    "home_usage_sethome" => "§cUsage: /sethome <name>",
                    "homes_list_prefix" => "§aYour available homes: §e",
                ],
                "database" => [
                    "file" => "homes.db",
                ],
            ];
            file_put_contents($configPath, yaml_emit($defaultConfig));
        }
        $this->config = new Config($configPath, Config::YAML);
    }

    public function getMessage(string $key): string {
        return $this->config->getNested("messages.$key", "§cMessage not found!");
    }

    public function getDatabaseFile(): string {
        return $this->config->getNested("database.file", "homes.db");
    }
}
