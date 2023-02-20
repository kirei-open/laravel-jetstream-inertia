<?php

namespace App\Repositories;

use App\Interfaces\GroupRepositoryInterface;
use App\Models\Group;

class GroupRepository implements GroupRepositoryInterface
{
    public function getAllGroups()
    {
        return Group::all();
    }
    public function getGroupById($groupId)
    {
        return Group::findOrFail($groupId);
    }
    public function deleteGroup($groupId)
    {
        Group::destroy($groupId);
    }
    public function createGroup(array $groupDetails)
    {
        return Group::create($groupDetails);
    }
    public function updateGroup($groupId, array $newDetails)
    {
        return Group::whereId($groupId)->update($newDetails);
    }

}
