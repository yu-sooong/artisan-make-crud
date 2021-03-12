<?php
namespace App\Http\Services;

use App\Http\Repository\UserRepository;

class UserService
{
    protected $_userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->_userRepository = $userRepository;
    }

    /**
     * get list
     * @param $request
     * @return mixed
     */
    public function getList($request)
    {
        return $this->_userRepository->getList($request);
    }

    /**
     * get single data
     * @param $id
     * @return mixed
     */
    public function getSingleData($id)
    {
        $select = ["id", "name"];
        return $this->_userRepository->getSingleData($id, $select);
    }

    /**
     * create
     * @param $request
     * @return mixed
     */
    public function create($request)
    {
        return $this->_userRepository->create($request);
    }


    /**
     * destroy
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        return $this->_userRepository->delete($id);
    }

    /**
     * update
     * @param $id
     * @param $request
     * @return mixed
     */
    public function update($id, $request)
    {
        return $this->_userRepository->update($id, $request);
    }
}
