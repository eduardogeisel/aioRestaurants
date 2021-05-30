<?php

    class EmployeeConverter{

        public static function convertFromStdClass($data){

            try{

                if(is_array($data)){

                    $employeeArray = [];

                    for($i = 0; $i < count($data); $i++){

                        if( get_class($data[$i]) == "stdClass"){

                            array_push(
                                $employeeArray,
                                self::parseToEmployee($data[$i])
                            );
                        } else {
                            throw new Exception("This is not a valid stdClass! - $i");
                        }
                    }

                    return $employeeArray;

                } else if(get_class($data) == "stdClass"){
                   
                    return self::parseToEmployee($data);

                } else {
                    throw new Exception("This is not a valid stdClass!");
                }

            } catch(Exception $error){
                echo $error->getMessage();
            }
        }

        public static function convertToStdClass($data){
            
            try{

                if(is_array($data)){

                    $employeeArray = [];

                    for($i = 0; $i < count($data); $i++){

                        if( get_class($data[$i]) == "Employee" ) {
                            array_push(
                                $employeeArray,
                                self::parseToStd($data[$i])
                            );

                        } else {
                            throw new Exception("This is not a valid Employee! - $i");
                        }
                        
                    }

                    return $employeeArray;

                } else if(get_class($data) == "Employee"){
                    
                    return self::parseToStd($data);
                    
                } else {
                    throw new Exception("This is not a valid Employee!");
                }

            } catch(Exception $error){
                echo $error->getMessage();
            }
        }

        private static function parseToStd(Employee $employee) : stdClass{
            $stdClass = new stdClass();

            if( $employee->getId() != null ) {
                $stdClass->_id = $employee->getId();
            }
            
            $stdClass->employeeId   = $employee->getEmployeeId();
            $stdClass->firstName    = $employee->getFirstName();
            $stdClass->lastName     = $employee->getLastName();
            $stdClass->bDate        = $employee->getBDate();
            $stdClass->address      = $employee->getAddress();
            $stdClass->city         = $employee->getCity();
            $stdClass->phone        = $employee->getPhone();
            $stdClass->email        = $employee->getEmail();
            $stdClass->picture      = $employee->getPicture();
            $stdClass->notes        = $employee->getNotes();
            $stdClass->userCategory = $employee->getUserCategory();
            $stdClass->username     = $employee->getUsername();
            $stdClass->password     = $employee->getPassword();

            return $stdClass;
        }

        private static function parseToEmployee(stdClass $stdClass) : Employee{
            $newEmployee = new Employee(
                $stdClass->employeeId,
                $stdClass->firstName,
                $stdClass->lastName,
                $stdClass->bDate,
                $stdClass->address,
                $stdClass->city,
                $stdClass->phone,
                $stdClass->email,
                $stdClass->picture,
                $stdClass->notes,
                $stdClass->userCategory,
                $stdClass->username,
                $stdClass->password
            );
            if($stdClass->_id != null){
                $newEmployee->setId($stdClass->_id);
            }
            return $newEmployee;
        }
    }