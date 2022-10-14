<?php

namespace Models;
use \PDO;

class Student
{
    public $id;
	public $firstName;
	public $lastName;
	public $studentNumber;
    public $email;
    public $contact;
    public $program;

	// Database Connection Object
	protected $connection;

    public function __construct($firstName, $lastName, $studentNumber, $email, $contact, $program)
	{
		$this->first_name = $firstName;
        $this->last_name = $lastName;
        $this->student_number = $studentNumber;
        $this->email = $email;
        $this->contact = $contact;
        $this->program = $program;
        
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

	public function getStudentNumber()
	{
		return $this->student_number;
	}

    public function getEmail()
	{
		return $this->email;
	}

    public function getContact()
	{
		return $this->contact;
	}

    public function getProgram()
	{
		return $this->program;
	}

	public function setConnection($connection)
	{
		$this->connection = $connection;
	}

	public function addStudent()
	{
		try {
			$sql = "INSERT INTO students SET first_name=:first_name, last_name=:last_name, student_number=:student_number, email=:email, contact=:contact, program=:program";
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				':first_name' => $this->getFirstName(),
				':last_name' => $this->getLastName(),
                ':student_number' => $this->getStudentNumber(),
                ':email' => $this->getEmail(),
                ':contact' => $this->getContact(),
                ':program' => $this->getProgram(),

			]);
			$this->id = $this->connection->getID();
			return $this;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function getById($id)
	{
		try {
			$sql = 'SELECT * FROM students WHERE id=:id';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				':id' => $id
			]);

			$row = $statement->fetch();

			$this->id = $row['id'];
			$this->first_name = $row['first_name'];
			$this->last_name = $row['last_name'];
			$this->student_number = $row['student_number'];
            $this->email = $row['email'];
            $this->contact = $row['contact'];
            $this->program = $row['program'];

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function update($firstName, $lastName, $studentNumber, $email, $contact, $program)
	{
		try {
			$sql = 'UPDATE students SET first_name=?, last_name=?,student_number=?, email=?, $contact=?, program=? WHERE id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$firstName,
				$lastName,
                $studentNumber,
                $email,
                $contact,
                $program,
				$this->getID()
			]);
			$this->first_name = $firstName;
			$this->last_name = $lastName;
            $this->student_number = $studentNumber;
            $this->email = $email;
            $this->contact = $contact;
            $this->program = $program;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function delete()
	{
		try {
			$sql = 'DELETE FROM students WHERE id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$this->getId()
			]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function getAll()
	{
		try {
			$sql = 'SELECT * FROM students';
			$data = $this->connection->query($sql)->fetchAll();
			return $data;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

}