<?php

namespace App\Http\Controllers;

use App\Interfaces\GroupRepositoryInterface;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    private GroupRepositoryInterface $groupRepository;

    public function __construct(GroupRepositoryInterface $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }

    public function index()
    {
        $groups = $this->groupRepository->getAllGroups();
        return ['groups' => $groups];
    }

    public function create()
    {
        return view('groups.create');
    }

    public function edit(Request $request)
    {
        $groupId = $request->route('groupId');

        $group = $this->groupRepository->getGroupById($groupId);

        if (empty($group)) {
            return back();
        }

        return view('group.edit', ['group' => $group]);
    }

    public function store(Request $request)
    {
        $groupDetails = [
            'name' => $request->name,
            'description' => $request-> description
        ];

        $this->groupRepository->createGroup($groupDetails);

        return $this->groupRepository->getAllGroups();
    }

    public function update(Request $request)
    {
        $groupId = $request->route('groupId');

        $groupDetails = [
            'name' => $request->name,
            'description' => $request->description
        ];

        $this->groupRepository->updateGroup($groupId, $groupDetails);

        return redirect()->Route('groups');
    }

    public function destroy(Request $request)
    {
        $groupId = $request->route('groupId');

        $this->groupRepository->deleteGroup($groupId);

        return back();
    }
}
