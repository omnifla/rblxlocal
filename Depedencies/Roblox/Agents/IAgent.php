<?php
namespace Roblox\Agents;

interface IAgent
{
	public function getId(): int;

	public function getAgentType(): AgentType;

	public function getAgentTargetId(): int;
}
