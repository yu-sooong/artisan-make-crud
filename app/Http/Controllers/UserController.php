<?php
namespace App\Http\Controllers;

use App\Http\Services\UserService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    private $_userService;

    public function __construct(UserService $userService)
    {
        $this->_userService = $userService;
    }

    /**
     * index
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $list = $this->_userService->getList($request->all());
        return response()->json($list);
    }

    /**
     * show
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $data = $this->_userService->getSingleData($id);
            return response()->json($data);
        } catch (ModelNotFoundException $e) {
            return response()->json('找無此資料', 404);
        } catch (\Exception $e) {
            return response()->json('請聯絡管理員', 400);
        }
    }

    /**
     * store
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $this->_userService->create($request->all());
            DB::commit();
            return response()->noContent(201);
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            return response()->json('請聯絡管理員', 400);
        }
    }

    /**
     * update
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $this->_userService->update($id, $request->all());
            DB::commit();
            return response()->noContent(200);
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return response()->json('找無此資料', 404);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json('請聯絡管理員', 400);
        }
    }

    /**
     * destroy
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $this->_userService->destroy($id);
            DB::commit();
            return response()->noContent(204);
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return response()->json('找無此資料', 404);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json('請聯絡管理員', 400);
        }
    }
}
