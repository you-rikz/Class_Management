<?php

namespace Models;
use \PDO;

class Teacher
{
    public $id;
	public $first_name;
	public $last_name;
    public $email;
    public $contact;
    public $employee_number;

	// Database Connection Object
	protected $connection;

    public function __construct($first_name, $last_name, $email, $contact, $employee_number)
	{
		$this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->contact = $contact;
        $this->employee_number = $employee_number;
        
	}

	public function getID()
	{
		return $this->id;
	}

	public function getFirstName()
	{
		return $this->first_name;
	}

	public function getLastName()
	{
		return $this->last_name;
	}

    public function getEmail()
	{
		return $this->email;
	}

    public function getContact()
	{
		return $this->contact;
	}

    public function getEmployeeNumber()
	{
		return $this->employee_number;
	}

	public function setConnection($connection)
	{
		$this->connection = $connection;
	}

	public function addTeacher()
	{
		try {
			$sql = "INSERT INTO teachers SET first_name=:first_name, last_name=:last_name, email=:email, contact=:contact, employee_number=:employee_number";
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
				':first_name' => $this->getFirstName(),
				':last_name' => $this->getLastName(),
                ':email' => $this->getEmail(),
                ':contact' => $this->getContact(),
                ':employee_number' => $this->getEmployeeNumber(),

			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function getById($id)
	{
		try {
			$sql = 'SELECT * FROM teachers WHERE id=:id';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				':id' => $id
			]);

			$row = $statement->fetch();

			$this->id = $row['id'];
			$this->first_name = $row['first_name'];
			$this->last_name = $row['last_name'];
            $this->email = $row['email'];
            $this->contact = $row['contact'];
            $this->employee_number = $row['employee_number'];

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function update($first_name, $last_name, $email, $contact, $employee_number)
	{
		try {
			$sql = 'UPDATE teachers SET first_name=?, last_name=?, email=?, contact=?, employee_number=? WHERE id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$first_name,
				$last_name,
                $email,
                $contact,
                $employee_number,
				$this->getID()
			]);
			
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function delete()
	{
		try {
			$sql = 'DELETE FROM teachers WHERE id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$this->getId()
			]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function showAllTeachers()
	{
		try {
			$sql = 'SELECT * FROM teachers';
			$data = $this->connection->query($sql)->fetchAll();
			return $data;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function viewClasses($id)
{
	try{
		$sql = 'SELECT * FROM teachers JOIN classes ON teachers.employee_number=classes.teacher_id WHERE teachers.id=:id';
		$statement = $this->connection->prepare($sql);
		$statement ->execute([ ':id' => $id	]);

	return $statement ->fetchAll();

	} catch (Exception $e) {
		error_log($e->getMessage());
	}
}

}