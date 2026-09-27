<?php
namespace Roblox\Agents;

use RuntimeException;

class AgentFactory implements IAgentFactory
{
	private static ?self $singleton = null;

	public static function getSingleton(): self
	{
		return self::$singleton ??= new self();
	}

	public static function get(int $agentId): ?IAgent
	{
		if ($agentId <= 0) {
			return null;
		}

		return Extensions::translate(Entities\Agent::get($agentId));
	}

	public static function mustGet(int $agentId): IAgent
	{
		return self::get($agentId)
			?? throw new RuntimeException("Could not retrieve Agent with ID=$agentId.");
	}

	public static function getByAgentTypeAndAgentTargetId(AgentType $agentType, int $agentTargetId): ?IAgent
	{
		if ($agentTargetId <= 0) {
			return null;
		}

		$entity = Entities\Agent::getByAgentTypeIdAndAgentTargetId($agentType->value, $agentTargetId);
		return Extensions::translate($entity);
	}
}
