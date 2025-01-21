<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\AccessModel;
use App\Models\CampaignModel;

class Home extends BaseController
{

    public function __construct()
    {
        helper(['form','url']);
        $this->user = new UserModel();
        $this->role =  new AccessModel();
        $this->campaign =  new CampaignModel();
        $this->pager = \Config\Services::pager();
    }


    public function index(){
        $db = \Config\Database::connect();
        $accessLevel = $this->request->getVar('role'); 
        $search = $this->request->getVar('search');
    
        $builder = $db->table('users');
        
        // Apply filters if provided
        if ($accessLevel) { 
            $builder->where('access_level', $accessLevel); 
        } 
        if ($search) { 
            $builder->groupStart()
                    ->like('firstname', $search)
                    ->orLike('lastname', $search)
                    ->orLike('email', $search)
                    ->groupEnd();
        }
    
        // Pagination settings
        $page = $this->request->getVar('page') ? (int)$this->request->getVar('page') : 1; 
        $perPage = 3; 
        $offset = ($page - 1) * $perPage;
    
        // Get the total number of rows for pagination 
        $totalRows = $builder->countAllResults(false);
    
        // Fetch the paginated results
        $builder->select('users.*, access_level.role as role')
                ->join('access_level', 'access_level.id = users.access_level', 'left')
                ->limit($perPage, $offset);
        $queryResult = $builder->get();
        $accessUser = $queryResult->getResult();
        
        // Load Pagination library 
        $pager = \Config\Services::pager();
    
        // Prepare data for the view 
        $data = [
            'accessUser' => $accessUser, 
            'pager' => $pager->makeLinks($page, $perPage, $totalRows, 'default_full'),
            'accessLevel' => $accessLevel,
            'search' => $search
        ];
    
        echo view('/layout/header');
        echo view('table', $data);
        echo view('/layout/footer');
    }
    
    

    public function saveUser(){
        $validationRules = [
            'firstname' => [
                'label' => 'Firstname',
                'rules' => 'required|min_length[3]|max_length[50]'
            ],
            'lastname' => [
                'label' => 'Lastname',
                'rules' => 'required|min_length[3]|max_length[50]'
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email'
            ],
            'role' => [
                'label' => 'Role',
                'rules' => 'required'
            ]
        ];

            if($this->validate($validationRules)) {
                $firstname = $this->request->getVar('firstname');
                $lastname = $this->request->getVar('lastname');
                $email = $this->request->getVar('email');
                $accessRole = $this->request->getVar('role');

                $this->user->save(["firstname" => $firstname, "lastname" => $lastname,"email"=>$email, "access_level" => $accessRole,]);

                session()->setFlashdata("success","Data inserted successfully");
                return redirect()->to(base_url());
            }else{
                $data['validation'] = $this->validator;
                echo view('/layout/header');
                // echo view('/layout/template');
                echo view('table', $data);
                echo view('/layout/footer');
            }

    }

    public function getSingleUser($id){
        $data = $this->user->where('id',$id)->first();
        echo json_encode($data);
    }

    public function updateUser(){
        $db = \Config\Database::connect();
    
        $validationRules = [
            'firstname' => [
                'label' => 'Firstname',
                'rules' => 'required|min_length[3]|max_length[50]'
            ],
            'lastname' => [
                'label' => 'Lastname',
                'rules' => 'required|min_length[3]|max_length[50]'
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email'
            ],
            'role' => [
                'label' => 'Role',
                'rules' => 'required'
            ]
        ];
    
        if ($this->validate($validationRules)) {
            $id = $this->request->getVar('updateId');
            $firstname = $this->request->getVar('firstname');
            $lastname = $this->request->getVar('lastname');
            $email = $this->request->getVar('email');
            $accessRole = $this->request->getVar('role');
    
            $data = [
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => $email,
                'access_level' => $accessRole
            ];
    
            if ($this->user->update($id, $data)) {
                return redirect()->to(base_url())->with('success', 'User updated successfully.');
            } else {
                return redirect()->to(base_url())->with('fail', 'Failed to update user.');
            }
        } else {
            $data['validation'] = $this->validator;
            echo view('/layout/header');
            echo view('table', $data);
        }
    }
    
    public function deleteUser(){
        $id = $this->request->getVar('id');
        $this->user->delete($id);
        echo "deleted";
    }

    // public function filterUsers() {
    //     $role = $this->request->getVar('role');
    //     $db = \Config\Database::connect();
    
    //     $query = "SELECT * FROM users";
    //     if ($role !== '') {
    //         $query .= " WHERE role = " . $db->escape($role);
    //     }
    
    //     $queryResult = $db->query($query);
    //     $users = $queryResult->getResult();
    
    //     // Update your data array with the filtered results
    //     $data['accessUser'] = $users;
    
    //     // Load the table view as partial
    //     echo view('table', $data);
    // }

    public function filterUsers() {
        $role = $this->request->getVar('role');
        $search = $this->request->getVar('search');
        $db = \Config\Database::connect();
    
        $query = "SELECT * FROM users WHERE 1=1";
        if ($role !== '') {
            $query .= " AND role = " . $db->escape($role);
        }
        if ($search !== '') {
            $query .= " AND (firstname LIKE '%" . $db->escapeLikeString($search) . "%' OR email LIKE '%" . $db->escapeLikeString($search) . "%')";
        }
        $queryResult = $db->query($query);
        $users = $queryResult->getResult();
    
        // Update your data array with the filtered results
        $data['accessUser'] = $users;
    
        // Load the table view as partial
        echo view('user_table', $data);
    }
    
    // public function campaign(){ 
    //     $data['campaign'] = 'campaign'; 
    //     $data['campaigns'] = $this->campaign->paginate(25); 
    //     echo view('/layout/header'); 
    //     // echo view('/layout/template'); 
    //     echo view('campaign', $data); 
    //     echo view('/layout/footer'); 
    // }

    public function campaign() {
        $db = \Config\Database::connect();
        $status = $this->request->getVar('status'); 
        $search = $this->request->getVar('search');
        // $data['campaigns'] = $this->campaign->paginate(25);
        // $data['campaign'] = 'campaign';
    
        $page = $this->request->getVar('page') ? $this->request->getVar('page') : 1; 
        $perPage = 3; 
        $offset = ($page - 1) * $perPage;

        // Pagination settings
        $page = $this->request->getVar('page') ? $this->request->getVar('page') : 1; 

        $builder = $db->table('campaign'); 
        if ($status) { 
            $builder->where('status', $status); 
        } 
        if ($search) { 
            $builder->like('name', $search)->orLike('description', $search)->orLike('client', $search)->orLike('supervisor', $search);
        }
            
        // Get the total number of rows for pagination 
       
        // $totalRows = $db->query("SELECT COUNT(*) as count FROM campaign")->getRow()->count;
        $totalRows = $builder->countAllResults(false);

         // Fetch the paginated results 
         $builder->limit($perPage, $offset); 
         $query = $builder->get(); 
         $campaigns = $query->getResult(); 
         // Load Pagination library 
         $pager = \Config\Services::pager(); 
         // Prepare data for the view 
         $data = [ 
            'campaigns' => $campaigns, 
            'pager' => $pager->makeLinks($page, $perPage, $totalRows, 'default_full'), 
            'status' => $status, 
            'search' => $search 
        ];
        //  $query = "SELECT * FROM campaign LIMIT $perPage OFFSET $offset";
        //  $queryResult = $db->query($query);
        //  $campaigns = $queryResult->getResult();
    
        // $pager = \Config\Services::pager();
    
        //  $data = [
        //     'campaigns' => $campaigns,
        //     'campaign' => 'campaign',
        //     'pager' => $pager->makeLinks($page, $perPage, $totalRows, 'default_full')
        // ];

        echo view('/layout/header');
        // echo view('/layout/template');
        echo view('campaign',$data);
        echo view('/layout/footer');
    }
    
    public function saveCampaign(){
        $validationRules = [
            'name' => [
                'label' => 'Name',
                'rules' => 'required'
            ],
            'description' => [
                'label' => 'Description',
                'rules' => 'required|max_length[50]'
            ],
            'client' => [
                'label' => 'Client',
                'rules' => 'required|max_length[50]'
            ],
            'supervisor' => [
                'label' => 'Supervisor',
                'rules' => 'permit_empty|max_length[50]' 
            ],
            // 'state' => [
            //     'label' => 'State',
            //     'rules' => 'required|in_list[active,inactive]' 
            // ],
        ];

            if($this->validate($validationRules)) {
                $name = $this->request->getVar('name');
                $description = $this->request->getVar('description');
                $client = $this->request->getVar('client');
                $supervisor = $this->request->getVar('supervisor');
                $state = $this->request->getVar('state');

                $this->campaign->save(["name" => $name, "description" => $description,"client"=>$client, "supervisor" => $supervisor,"state" => $state]);

                session()->setFlashdata("success","Data inserted successfully");
                return redirect()->to(base_url("/campaign"));
            }else{
                $data['validation'] = $this->validator;
                echo view('/layout/header');
                // echo view('/layout/template');
                echo view('campaign', $data);
                echo view('/layout/footer');
            }
    }

    public function updateCampaign() {
        $db = \Config\Database::connect();
    
        $validationRules = [
            'name' => [
                'label' => 'Name',
                'rules' => 'required|min_length[3]|max_length[50]'
            ],
            'description' => [
                'label' => 'Description',
                'rules' => 'required'
            ]
        ];
    
        if ($this->validate($validationRules)) {
            $id = $this->request->getVar('id');
            $name = $this->request->getVar('name');
            $description = $this->request->getVar('description');
            $client = $this->request->getVar('client');
            $supervisor = $this->request->getVar('supervisor');
            $state = $this->request->getVar('state');
    
            $data = [
                'name' => $name,
                'description' => $description,
                'client' => $client,
                'supervisor' => $supervisor,
                'state' => $state,
            ];
    
            $this->campaign->update($id, $data);
            return redirect()->to(base_url("/campaign"));
        } else {
            $data['validation'] = $this->validator;
            echo view('/layout/header');
            echo view('campaign', $data);
            echo view('/layout/footer');
        }
    }
    
    public function getSingleCampaign($id){
        $data = $this->campaign->where('id',$id)->first();
        echo json_encode($data, true);
    }

    public function deleteCampaign() {
        $id = $this->request->getVar('id');
        if ($this->campaign->delete(['id' => $id])) {
            echo "deleted";
        } else {
            echo "failed";
        }
    }
    

    public function access(){
        // $data['access'] = 'access';
        $data['roles'] = $this->role->paginate(15);
        echo view('/layout/header');
        // echo view('layout/template');
        echo view('access', $data);
        echo view('layout/footer');
    }

    public function addRole() {
        $validationRules = [
            'role' => [
                'label' => 'Role',
                'rules' => 'required'
            ]
        ];
    
        if ($this->validate($validationRules)) {
            $role = $this->request->getVar('role');
            $this->role->save(['role' => $role]);
            session()->setFlashdata('success', 'Role added successfully');
            return redirect()->to(base_url("/access")); // Change to your desired redirect URL
        } else {
            $data['validation'] = $this->validator;
            echo view('/layout/header');
            // echo view('/layout/template');
            echo view('access', $data);
            echo view('/layout/footer');
        }
    }

    public function getSingleRole($id){
        $data = $this->access->where('id',$id)->first();
        echo json_encode($data, true);
    }

    public function updateRole() {
        $validationRules = [
            'role' => [
                'label' => 'Role',
                'rules' => 'required'
            ]
        ];
    
        if ($this->validate($validationRules)) {
            $id = $this->request->getVar('updateId');
            $role = $this->request->getVar('role');
    
            $this->role->update($id, ['role' => $role]);
    
            session()->setFlashdata('success', 'Role updated successfully');
            return redirect()->to(base_url('/access')); 
        } else {
            $data['validation'] = $this->validator;
            echo view('/layout/header');
            echo view('access', $data);
        }
    }

    public function deleteRole() { 
        $id = $this->request->getVar('id'); 
        $this->role->delete($id); 
        echo "deleted"; 
    }

    public function home(){
        echo view('/layout/header');
        echo view('layout/template');
        echo view('home');
        echo view('layout/footer');
    }

    public function table(){
        if(!session()->get('isLoggedIn')){
            return redirect()->to('/login');
        }
        echo view('/layout/header');
        echo view('/layout/template');
        echo view('home');
        echo view('/layout/footer');
    }

    public function chat(){
        if(!session()->get('isLoggedIn')){
            redirect()->to('/login');
            return;
        }
        echo view('chat');
    }
}
