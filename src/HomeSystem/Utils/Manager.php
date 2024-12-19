<?php

namespace HomeSystem\Utils;

use pocketmine\utils\Config;

class Manager {

    private string $dataFolder;

    public function __construct(string $dataFolder) {
        $this->dataFolder = $dataFolder . "Homes/";
        if (!is_dir($this->dataFolder)) {
            mkdir($this->dataFolder, 0777, true);
        }
    }

    public function setHome(string $playerName, string $homeName, array $homeData): void {
        $filePath = $this->getFilePath($playerName);
        $config = new Config($filePath, Config::YAML);
        $homes = $config->getAll();
        $homes[$homeName] = $homeData;
        $config->setAll($homes);
        $config->save();
    }

    public function getHome(string $playerName, string $homeName): ?array {
        $filePath = $this->getFilePath($playerName);
        if (!file_exists($filePath)) {
            return null;
        }

        $config = new Config($filePath, Config::YAML);
        return $config->get($homeName, null);
    }
    public function getAllHomes(string $playerName): array {
        $filePath = $this->getFilePath($playerName);
        if (!file_exists($filePath)) {
            return [];
        }

        $config = new Config($filePath, Config::YAML);
        return $config->getAll();
    }

    public function deleteHome(string $playerName, string $homeName): bool {
        $filePath = $this->getFilePath($playerName);
        if (!file_exists($filePath)) {
            return false;
        }

        $config = new Config($filePath, Config::YAML);
        $homes = $config->getAll();
        if (isset($homes[$homeName])) {
            unset($homes[$homeName]);
            $config->setAll($homes);
            $config->save();
            return true;
        }
        return false;
    }
    private function getFilePath(string $playerName): string {
        return $this->dataFolder . strtolower($playerName) . ".yml";
    }
}
