<?php
namespace Roblox;

enum GroupRoleSetPermissionName: string
{
    case CanDeletePosts = 'CanDeletePosts';
    case CanPostToWall = 'CanPostToWall';
    case CanInviteMembers = 'CanInviteMembers';
    case CanPostToStatus = 'CanPostToStatus';
    case CanRemoveMembers = 'CanRemoveMembers';
    case CanViewStatus = 'CanViewStatus';
    case CanViewWall = 'CanViewWall';
    case CanChangeRank = 'CanChangeRank';
    case CanAdvertise = 'CanAdvertise';
    case CanManageRelationships = 'CanManageRelationships';
    case CanAddGroupPlaces = 'CanAddGroupPlaces';
    case CanViewAuditLog = 'CanViewAuditLog';
    case CanCreateItems = 'CanCreateItems';
    case CanManageItems = 'CanManageItems';
    case CanSpendGroupFunds = 'CanSpendGroupFunds';
    case CanManageClan = 'CanManageClan';
    case CanManageGroupGames = 'CanManageGroupGames';
}
