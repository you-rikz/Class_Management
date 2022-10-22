<?php

namespace Models;
use \PDO;

class ClassRecord
{
    public $id;
	public $class_name;
    public $code;
    public $class_description;
    public $teacher_id;

	// Database Connection Object
	protected $connection;

    public function __construct($class_name, $code, $class_description, $teacher_id)
	{
		$this->class_name = $class_name;
        $this->code = $code;
        $this->class_description = $class_description;
        $this->teacher_id = $teacher_id;
    
	}

	public function getID()
	{
		return $this->id;
	}

	public function getClassName()
	{
		return $this->class_name;
	}

	public function getClassCode()
	{
		return $this->code;
	}

    public function getDescription()
	{
		return $this->class_description;
	}

    public function getTeacherID()
	{
		return $this->teacher_id;
	}


	public function setConnection($connection)
	{
		$this->connection = $connection;
	}

	public function addClass()
	{
		try {
			$sql = "INSERT INTO classes SET class_name=:class_name, code=:code, class_description=:class_description, teacher_id=:teacher_id";
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
				':class_name' => $this->getClassName(),
				':code' => $this->getClassCode(),
                ':class_description' => $this->getDescription(),
                ':teacher_id' => $this->getTeacherID(),
                

			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function getById($id)
	{
		try {
			$sql = 'SELECT * FROM classes WHERE id=:id';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				':id' => $id
			]);

			$row = $statement->fetch();

			$this->id = $row['id'];
			$this->class_name = $row['class_name'];
			$this->code = $row['code'];
			$this->class_description = $row['class_description'];
            $this->teacher_id = $row['teacher_id'];
			
            
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function update($class_name, $code, $class_description, $teacher_id)
	{
		try {
			$sql = 'UPDATE classes SET class_name=?, code=?, class_description=?, teacher_id=? WHERE id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$class_name,
				$code,
                $class_description,
                $teacher_id,
				$this ->getID()
			]);


		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function delete()
	{
		try {
			$sql = 'DELETE FROM classes WHERE id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$this->getId()
			]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function showAllClasses()
	{
		try {
			$sql = 'SELECT classes.id, classes.class_name, classes.code, classes.class_description, teachers.first_name, teachers.last_name FROM classes JOIN teachers ON classes.teacher_id=teachers.id';
			$data = $this->connection->query($sql)->fetchAll();
			return $data;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

}