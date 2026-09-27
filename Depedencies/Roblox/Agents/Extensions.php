<?php
namespace Roblox\Agents;

final class Extensions
{
	public static function translate(?object $entity): ?IAgent
	{
		if ($entity === null) {
			return null;
		}

		$agent = new Agent();
		$agent->Id = (int) $entity->ID;
		$agent->AgentType = AgentType::from((int) $entity->AgentTypeID);
		$agent->AgentTargetId = (int) $entity->AgentTargetID;

		return $agent;
	}
}
