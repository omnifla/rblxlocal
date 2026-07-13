<?php
// ported by meditext
// helper class for creating and managing Lua script executions.
namespace Roblox\Grid;
use Roblox\Grid\Rcc\ScriptExecution;
use Roblox\Grid\Rcc\LuaType;

class Lua
{
	public static ScriptExecution $EmptyScript;

	public static function init()
	{
		self::$EmptyScript = self::NewScript("EmptyScript", "return");
	}

	public static function NewScript(string $name, string $script): ScriptExecution
	{
		return self::NewScriptWithArgs($name, $script, self::NewArgs());
	}

	public static function NewScriptWithParams(string $name, string $script, ...$args): ScriptExecution
	{
		return self::NewScriptWithArgs($name, $script, self::NewArgs(...$args));
	}

	public static function NewScriptWithArgs(string $name, string $script, array $args): ScriptExecution
	{
		$scriptExecution = new ScriptExecution($name, $script, $args);
		return $scriptExecution;
	}

	public static function ToString(array $result): string
	{
		$text = null;
		foreach ($result as $val) {
			$text = (!empty($text) ? ($text . ", " . $val->value) : $val->value);
		}
		return $text;
	}

	public static function SetArg(array &$args, int $index, $value): void
	{
		$val = new LuaValue();
		if (is_int($value) || is_float($value) || is_double($value)) {
			$val->type = LuaType::LUA_TNUMBER;
			$val->value = (string)$value;
		} elseif (is_string($value)) {
			$val->type = LuaType::LUA_TSTRING;
			$val->value = $value;
		} elseif (is_bool($value)) {
			$val->type = LuaType::LUA_TBOOLEAN;
			$val->value = $value ? "true" : "false";
		} elseif (is_null($value)) {
			$val->type = LuaType::LUA_TNIL;
			$val->value = "";
		} elseif (is_array($value)) {
			$val->type = LuaType::LUA_TTABLE;
			$val->table = $value;
		} else {
			throw new \InvalidArgumentException("Unsupported Lua argument type " . gettype($value));
		}
		$args[$index] = $val;
	}

	private static function ConvertLua(LuaValue $luaValue)
	{
		switch ($luaValue->type) {
			case LuaType::LUA_TBOOLEAN:
				return filter_var($luaValue->value, FILTER_VALIDATE_BOOLEAN);
			case LuaType::LUA_TNUMBER:
				return (float)$luaValue->value;
			case LuaType::LUA_TSTRING:
				return $luaValue->value;
			case LuaType::LUA_TTABLE:
				return self::GetValues($luaValue->table);
			default:
				return null;
		}
	}

	public static function NewArgs(...$args): array
	{
		$largs = [];
		foreach ($args as $i => $arg) {
			self::SetArg($largs, $i, $arg);
		}
		return $largs;
	}

	public static function GetValues(array $args): array
	{
		$values = [];
		foreach ($args as $i => $arg) {
			$values[$i] = self::ConvertLua($arg);
		}
		return $values;
	}
}

//Lua::init();