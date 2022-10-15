<?php

namespace Models;
use \PDO;

class ClassRoster
{
    protected $id;
	protected $class_code;
	protected $student_number;
    protected $enrolled_at;
	// Database Connection Object
	protected $connection;

    public function __construct($class_code, $student_number, $enrolled_at)
	{
		$this->class_code = $class_code;
        $this->student_number = $student_number;
        $this->enrolled_at = $enrolled_at;
    
	}

	public function getID()
	{
		return $this->id;
	}

	public function getClassCode()
	{
		return $this->class_code;
	}

	public function getStudentNumber()
	{
		return $this->student_number;
	}

    public function enrolledAt()
	{
		return $this->enrolled_at;
	}

	public function setConnection($connection)
	{
		$this->connection = $connection;
	}

	public function addClassRoster()
	{
		try {
			$sql = "INSERT INTO class_rosters SET class_code=:class_code, student_number=:student_number, enrolled_at=:enrolled_at";
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				':class_code' => $this->getClassCode(),
				':student_number' => $this->getStudentNumber(),
                ':enrolled_at' => $this->enrolledAt(),
                
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
			$sql = 'SELECT * FROM class_rosters WHERE id=:id';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				':id' => $id
			]);

			$row = $statement->fetch();

			$this->id = $row['id'];
			$this->class_code = $row['class_code'];
			$this->student_number = $row['student_number'];
            $this->enrolled_at = $row['enrolled_at'];
           
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function update($class_code, $student_number, $enrolled_at)
	{
		try {
			$sql = 'UPDATE class_rosters SET class_code=?, student_number=?, enrolled_at=?, WHERE id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$class_code,
                $student_number,
                $enrolled_at,
				$this->getID()
			]);
			$this->class_code = $class_code;
			$this->student_number = $student_number;
            $this->enrolled_at = $enrolled_at;
            
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function delete()
	{
		try {
			$sql = 'DELETE FROM class_rosters WHERE id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$this->getId()
			]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function showClassesRosters()
	{
		try {
			$sql = 'SELECT * FROM class_rosters';
			$data = $this->connection->query($sql)->fetchAll();
			return $data;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

}