<?php

namespace App\Controllers;

use \Myth\Auth\Models\UserModel;
use \Myth\Auth\Password;
use \Myth\Auth\Authorization\GroupModel;

class Users extends BaseController
{

    public function index()
    {
        // Load models
        $userModel = new UserModel();
        $groupModel = new GroupModel();

        // Fetch all users
        $users = $userModel->findAll();

        // Add groups for each user
        foreach ($users as &$user) {
            $user->group = $groupModel->getGroupsForUser($user->id); // Fetch group data for the user
        }

        // Prepare data for the view
        $data = [
            'title' => 'Users',
            'users' => $users,
            'groups' => $groupModel->findAll(), // Get all groups for dropdown
        ];

        // Return view with data
        return view('users/index', $data);
    }


    public function activate()
    {
        $userModel = new UserModel();

        $id = $this->request->getPost('id');
        $active = $this->request->getPost('active');

        // Validasi input
        if (!$id || $active === null) {
            return redirect()->back()->with('error', 'Data tidak valid.');
        }

        $data = [
            'active' => intval($active), // Set status aktif
            'activate_hash' => null,    // Reset hash jika diperlukan
        ];

        // Perbarui data pengguna
        if ($userModel->update($id, $data)) {
            return redirect()->to(base_url('/users/index'))->with('success', 'Status pengguna berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui status pengguna.');
        }
    }


    public function changePassword($id = null)
    {
        if ($id == null) {
            return redirect()->to(base_url('/users/index'));
        } else {
            $data = [
                'id' => $id,
                'title' => 'Update Password',
            ];
            return view('users/set_password', $data);
        }
    }

    public function setPassword()
    {
        $id = $this->request->getVar('id');
        $rules = [
            'password'     => 'required|strong_password',
            'pass_confirm' => 'required|matches[password]',
        ];

        // Validasi form
        if (! $this->validate($rules)) {
            $data = [
                'id' => $id,
                'title' => 'Update Password',
                'validation' => $this->validator,
            ];

            return view('users/set_password', $data);
        } else {
            $userModel = new UserModel();
            $data = [
                'password_hash' => Password::hash($this->request->getVar('password')),
                'reset_hash' => null,
                'reset_at' => null,
                'reset_expires' => null,
            ];

            // Perbarui data password di database
            $userModel->update($this->request->getVar('id'), $data);

            return redirect()->to(base_url('/users/index'))->with('success', 'Kata sandi berhasil diperbarui.');
        }
    }



    public function changeGroup()
    {
        $userId = $this->request->getPost('id');
        $groupId = $this->request->getPost('group');

        // Validasi input
        if (!$userId || !$groupId) {
            return redirect()->back()->with('error', 'Data tidak valid.');
        }

        // Operasi grup
        $groupModel = new GroupModel();
        $groupModel->removeUserFromAllGroups(intval($userId));
        $groupModel->addUserToGroup(intval($userId), intval($groupId));

        return redirect()->to(base_url('/users/index'))->with('success', 'Grup pengguna berhasil diperbarui.');
    }
}
