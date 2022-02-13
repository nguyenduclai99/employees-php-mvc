<?php

class EmployeesController implements ControllerInterface
{
    /**
     * $employees model instance
     * @var Employees
     */
    private $employees;

    public function __construct($employees)
    {
        $this->employees = $employees;
    }

    public function index($request)
    {
        $employees = $this->employees->select();
        $indexView = new IndexView();
        $indexView->renderView($employees);
    }

    public function create($request)
    {
        $employees = [];
        if (!empty($request['id'])) {
            $where = "id=" . $request['id'];
            $employees = $this->employees->select($where);
        }
        $indexView = new IndexView();
        $indexView->renderView($employees);
    }

    public function store($request)
    {
        $store = $this->employees->create($request);
        $action = "/?success=true";
        if (!$store) {
            $action = "/?success=false";
        }
        $this->redirectAction($action);
    }

    public function update($request)
    {
        $update = $this->employees->update($request);
        $action = "/?success=true&action=updateEmployees";
        if (!$update) {
            $action = "/?success=false&action=updateEmployees";
        }
        $this->redirectAction($action);
    }

    public function delete($request) 
    {
        if (empty($request['id'])) {
            $this->redirectAction('/?success=false&action=deleteEmployees');
        }

        $delete = $this->employees->delete($request['id']);
        $this->redirectAction('/?success=true&action=deleteEmployees');
    }

    public function detail($request)
    {
        if (empty($request['id'])) {
            $this->redirectAction('/?success=false&action=detail&detailEmployees');
        }
        $where = "id=" . $request['id'];

        $employees = $this->employees->select($where);
        $indexView = new IndexView();
        $indexView->renderView($employees);
    }

    public function redirectAction($route="/")
    {
        header("location: $route");
        exit;
    }
}