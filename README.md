# HomeSystem

**HomeSystem** is a PocketMine-MP plugin that allows players to set, manage, and delete homes within Minecraft. This plugin allows users to teleport to their home locations and manage them easily with commands.

## Features

- **Set a home**: Players can set a home at their current location using a custom name.
- **Teleport to home**: Players can teleport to their homes with a simple command.
- **Delete a home**: Players can remove homes they no longer need.
- **Multiple homes support**: Players can manage multiple homes, each identified by a unique name.

## Commands

- `/sethome <name>`: Set a home at your current location with the specified name.
- `/home [name]`: Teleport to a home. If no name is provided, teleport to the first available home.
- `/delhome <name>`: Delete a specified home.

## Installation

1. Download the `HomeSystem` plugin.
2. Place the plugin in the `plugins/` folder of your PocketMine-MP server.
3. Restart the server to enable the plugin.
4. The plugin will automatically generate a `config.yml` file and a folder for storing player homes data.

## Configuration

You can customize the messages and database file name in the `config.yml` file located in the plugin folder. This file allows you to adjust the messages players see when interacting with the plugin.

## Example Configuration (`config.yml`)

```yaml
messages:
  command_in_game_only: "§cThis command can only be used in-game."
  home_deleted: "§aYour home has been successfully deleted."
  home_not_set: "§cNo home found with this name."
  home_world_missing: "§cThe world for your home no longer exists or is not loaded."
  home_teleport_success: "§aSuccessfully teleported to your home."
  home_set_success: "§aYour home has been set successfully."
  home_already_exists: "§cA home with this name already exists."
  home_usage_delhome: "§cUsage: /delhome <name>"
  home_usage_home: "§cUsage: /home [name]"
  home_usage_sethome: "§cUsage: /sethome <name>"
  homes_list_prefix: "§aYour available homes: §e"

database:
  file: "homes.db"
