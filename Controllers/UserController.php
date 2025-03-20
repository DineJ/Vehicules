<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Entities\User;
use CodeIgniter\Controller;

class UserController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new UserModel();
    }

    public function index()
    {
        return view('User/index', ['items' => $this->model->findAll()]);
    }

    public function show($id)
    {
        return view('User/show', ['item' => $this->model->find($id)]);
    }

    public function create()
    {
        $data['title'] = 'Ajouter un nouvel User';
        return view('User/create', $data);
    }

    public function store()
    {
        $data = $this->request->getPost();
        $entity = new User();
        $entity->fill($data);
        
        if (!$this->model->insert($entity)) {
            return redirect()->back()->with('error', 'Erreur lors de l\'ajout.');
        }
        
        return redirect()->to('/User');
    }

    public function edit($id)
    {
        $model = new UserModel();
        $data['item'] = $model->find($id);
        $data['title'] = "Modifier User";
        return view('User/edit', $data);
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        $entity = $this->model->find($id);
        $entity->fill($data);

        if (!$this->model->save($entity)) {
            return redirect()->back()->with('error', 'Erreur lors de la mise à jour.');
        }

        return redirect()->to('/User');
    }

    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to('/User');
    }
}