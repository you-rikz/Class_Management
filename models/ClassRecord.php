<?php

namespace Models;
use \PDO;

class ClassRecord	
{
    protected $id;
	protected $class_name;
    protected $code;
    protected $descrip;
    protected $teacher_id;

	// Database Connection Object
	protected $connection;

    public function __construct($class_name, $code, $descrip, $teacher_id)
	{
		$this->class_name = $class_name;
        $this->code = $code;
        $this->class_description = $descrip;
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

    public function classDescrip()
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

	public function addClassRecord()
	{
		try {
			$sql = "INSERT INTO classes SET class_name=:class_name, code=:code, class_description=:class_description, teacher_id=:teacher_id";
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				':class_name' => $this->getClassName(),
				':code' => $this->getClassCode(),
                ':class_description' => $this->classDescrip(),
                ':teacher_id' => $this->getTeacherID(),
				
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

	public function update($class_name, $code, $descrip, $teacher_id)
	{
		try {
			$sql = 'UPDATE classes SET class_name=?, code=?, class_description=?, $teacher_id=?, WHERE id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$class_name,
				$code,
                $class_description,
                $teacher_id,
				$this->getID()
			]);
			$this->class_name = $class_name;
			$this->code = $code;
            $this->class_description = $class_description;
            $this->teacher_id = $teacher_id;
			
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
				$this->getID()
			]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function showAllClasses()
	{
		try {
			$sql = 'SELECT * FROM classes';
			$data = $this->connection->query($sql)->fetchAll();
			return $data;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

}