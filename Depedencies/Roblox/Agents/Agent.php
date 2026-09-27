<?php
namespace Roblox\Agents;

class Agent implements IAgent
{
	public int $Id = 0;
	public ?AgentType $AgentType = null;
	public int $AgentTargetId = 0;

	public function getId(): int
	{
		return $this->Id;
	}

	public function getAgentType(): AgentType
	{
		return $this->AgentType ?? throw new \LogicException('Agent type has not been initialized.');
	}

	public function getAgentTargetId(): int
	{
		return $this->AgentTargetId;
	}
}
