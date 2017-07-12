<?php

/**
 * Created by PhpStorm.
 * User: amrit
 * Date: 6/10/15
 * Time: 2:02 PM.
 */
namespace Pmis\Http\Controllers\Auth;

use Exception;
use Pmis\Eloquent\Designation;
use Pmis\Eloquent\District;
use Pmis\Eloquent\Office;
use Pmis\Eloquent\User;
use Pmis\Http\Controllers\Controller;
use Pmis\Http\Requests\ChangePasswordFormRequest;
use Pmis\Http\Requests\UserFormRequest;

/**
 * Class UsersController.
 */
class UsersController extends Controller
{
    /**
     *
     */
    public function __construct()
    {
        $this->middleware('user.central');
    }

    /**
     * @param User $user
     *
     * @return \Illuminate\View\View
     */
    public function index(User $user)
    {
        $users = $user->with('designation', 'district', 'office')->get();

        return view('auth.user.index', compact('users'));
    }

    /**
     * @param District    $district
     * @param Designation $designation
     * @param Office      $office
     *
     * @return \Illuminate\View\View
     */
    public function create(District $district, Designation $designation, Office $office)
    {
        $districts = $district->lists('name', 'id');

        $offices = $office->lists('office_name', 'id');

        $designations = $designation->lists('name', 'id');

        $password = str_random('8');

        return view('auth.user.create', compact('districts', 'designations', 'offices', 'password'));
    }

    /**
     * @param UserFormRequest $formRequest
     * @param User            $user
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(UserFormRequest $formRequest, User $user)
    {
        try {
            $user->fill($formRequest->all())->save();

            session()->flash('success', 'User saved successfully.');

            return redirect()->action('Auth\UsersController@index');
        } catch (Exception $e) {
            $this->handleFlashMessage($e);

            return redirect()->back()->withInput();
        }
    }

    /**
     * @param District    $district
     * @param Designation $designation
     * @param Office      $office
     * @param User        $userModel
     * @param $id
     *
     * @return \Illuminate\View\View
     */
    public function edit(District $district, Designation $designation, Office $office, User $userModel, $id)
    {
        $view = view('auth.user.edit');

        try {
            $user = $userModel->findOrFail($id);
            unset($user['password']);

            $districts = $district->lists('name', 'id');

            $offices = $office->lists('office_name', 'id');

            $designations = $designation->lists('name', 'id');

            $view->with(compact('user', 'offices', 'districts', 'designations'));
        } catch (ModelNotFoundException $e) {
            $this->handleModelNotFound($e);
        }

        return $view;
    }

    /**
     * Handle Designation Update Form Request.
     *
     * @param User            $userModel
     * @param UserFormRequest $userFormRequest
     * @param $id
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(User $userModel, UserFormRequest $userFormRequest, $id)
    {
        try {
            $inputs = $userFormRequest->all();

            if (empty($inputs['password'])) {
                unset($inputs['password']);
            }
            $inputs['status'] = $userFormRequest->get('status', 0);

            $user = $userModel->findOrFail($id);

            $user->fill($inputs)->save();

            session()->flash('success', 'User updated successfully.');

            return redirect()->action('Auth\UsersController@index');
        } catch (ModelNotFoundException $e) {
            $this->handleModelNotFound($e);

            return redirect()->back()->withInput();
        } catch (Exception $e) {
            $this->handleFlashMessage($e);

            return redirect()->back()->withInput();
        }
    }

    public function changePassword()
    {
        return view('auth.user.changePassword');
    }

    /**
     * Handle Designation Update Form Request.
     *
     * @param User                      $userModel
     * @param ChangePasswordFormRequest $changePasswordFormRequest
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function updatePassword(User $userModel, ChangePasswordFormRequest $changePasswordFormRequest)
    {
        try {
            $inputs = $changePasswordFormRequest->all();

            $user = $userModel->findOrFail(auth()->user()->getAuthIdentifier());
            return $user;

            $user->fill($inputs)->save();

            session()->flash('success', 'Your password updated successfully.');

            return redirect()->action('HomeController@index');
        } catch (ModelNotFoundException $e) {
            $this->handleModelNotFound($e);

            return redirect()->back()->withInput();
        } catch (Exception $e) {
            $this->handleFlashMessage($e);

            return redirect()->back()->withInput();
        }
    }
}
