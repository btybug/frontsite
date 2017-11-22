<?php namespace Btybug\FrontSite\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Btybug\btybug\Repositories\MenuRepository;
use Btybug\Console\Http\Requests\Structure\MenuCreateRequest;
use Btybug\Console\Http\Requests\Structure\MenuDeleteRequest;
use Btybug\Console\Http\Requests\Structure\MenuEditRequest;
use Btybug\Console\Repository\FrontPagesRepository;
use Btybug\Console\Services\StructureService;
use Btybug\User\Repository\RoleRepository;


class MenusController extends Controller
{
    public function getIndex(
        StructureService $structureService,
        RoleRepository $roleRepository,
        MenuRepository $menuRepository
    )
    {
        $menus = $menuRepository->getFrontend();
        return view('manage::frontend.menus.index', compact('menus'));
    }

    public function postCreate(
        MenuCreateRequest $request,
        MenuRepository $menuRepository
    )
    {
        $menuRepository->create([
            'name' => $request->name,
            'creator_id' => \Auth::id(),
            'place' => 'frontend',
            'type' => 'custom',
        ]);

        return back()->with('message', "menu successfully created");
    }

    public function postDelete(
        MenuDeleteRequest $request,
        MenuRepository $menuRepository
    )
    {
        $result = $menuRepository->findOrFail($request->id);
        $success = $result->delete();
        return \Response::json(['success' => $success, 'url' => url('admin/console/structure/menus')]);
    }

    public function getEdit(
        $id,
        MenuRepository $menuRepository,
        FrontPagesRepository $frontPagesRepository
    )
    {
        $menu = $menuRepository->findOrFail($id);
        $pageGrouped = $frontPagesRepository->getGroupedWithModule();
        return view('manage::frontend.menus.edit', compact(['menu','pageGrouped']));
    }

    public function postEdit(
        $id,
        MenuEditRequest $request,
        StructureService $structureService,
        MenuRepository $menuRepository,
        RoleRepository $roleRepository
    )
    {
        $menu = $menuRepository->find($id);
        $structureService->saveMenu($menu, $request);

        return redirect()->to('admin/front-site/structure/menus');
    }
}