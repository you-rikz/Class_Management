<?php

namespace Models;
use \PDO;

class ClassRoster
{
    public $id;
	public $class_code;
	public $student_number;

	// Database Connection Object
	public $connection;

    public function __construct($class_code, $student_number)
	{
		$this->class_code = $class_code;
        $this->student_number = $student_number;
        
    
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

    // public function enrolledAt()
	// {
	// 	return $this->enrolled_at;
	// }

	public function setConnection($connection)
	{
		$this->connection = $connection;
	}

	public function addStudentToRoster()
	{
		try {
			$sql = "INSERT INTO classes_rosters SET class_code=:class_code, student_number=:student_number";
			$statement = $this->connection->prepare($sql);

			return $statement -> execute([
				':class_code' => $this->getClassCode(),
				':student_number' => $this->getStudentNumber(),
			]);
			
			// $this->id = $this->connection->getID();
			// return $this;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function viewClasses($class_code)
{
	try{
		$sql = 'SELECT * FROM classes_rosters JOIN students ON classes_rosters.student_number=students.student_number WHERE classes_rosters.class_code=:class_code';
		$statement = $this->connection->prepare($sql);
		$statement ->execute([ ':class_code' => $class_code	]);

	return $statement ->fetchAll();

	} catch (Exception $e) {
		error_log($e->getMessage());
	}
}
	public function getById($id)
	{
		try {
			$sql = 'SELECT * FROM classes_rosters WHERE id=:id';
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

	// public function update($class_code, $student_number, $enrolled_at)
	// {
	// 	try {
	// 		$sql = 'UPDATE class_rosters SET class_code=?, student_number=?, enrolled_at=?, WHERE id=?';
	// 		$statement = $this->connection->prepare($sql);
	// 		$statement->execute([
	// 			$class_code,
    //             $student_number,
    //             $enrolled_at,
	// 			$this->getID()
	// 		]);
	// 		$this->class_code = $class_code;
	// 		$this->student_number = $student_number;
    //         $this->enrolled_at = $enrolled_at;
            
	// 	} catch (Exception $e) {
	// 		error_log($e->getMessage());
	// 	}
	// }

	public function delete()
	{
		try {
			$sql = 'DELETE FROM classes_rosters WHERE id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$this->getId()
			]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function showClassRosters()
	{
		try {
			$sql = 'SELECT classes.id, classes.class_name, classes.class_description, classes.code, teachers.first_name, teachers.last_name, (SELECT COUNT(student_number) FROM classes_rosters
			WHERE classes_rosters.class_code = classes.code) AS enrolled_students FROM classes INNER JOIN teachers on classes.teacher_id=teachers.employee_number;';
			$data = $this->connection->query($sql)->fetchAll();
			return $data;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

}