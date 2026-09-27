<?php
namespace Roblox\Agents;

interface IAgentFactory
{
	public static function get(int $agentId): ?IAgent;

	public static function mustGet(int $agentId): IAgent;

	public static function getByAgentTypeAndAgentTargetId(AgentType $agentType, int $agentTargetId): ?IAgent;
}
