<?php
//CREATIONAL PATTERN

//simple factory
/*
 * Được dùng khi một đoạn code nào đó được sử dụng lại nhiều lần, tức là nó chỉ tạo ra một khuôn mẫu
 * sẵn cho việc thực hiện một câu việc nào đó, ta chỉ cần truyền vào các dữ liệu đầu vào và nhận được
 * kết quả trả về.
 */
class Student {
    public $name;
    public $age;
    public function __construct($name, $age) {
        $this->name = $name;
        $this->age = $age;
    }
    public function getName() {
        return $this->name;
    }

    public function getAge() {
        return $this->age;
    }

}

class StudentInit {
    public static function createStudent($name, $age) {
        return new Student($name, $age);
    }
}

$sdt1 = StudentInit::createStudent('duy', 21);
echo "information: ".$sdt1->name." ".$sdt1->age;


//method factory
/*
 * Được dùng trong trường hợp có một công việc cần xử lý cho nhiều đối tượng nhưng yêu cầu các
 * subclass để thực hiện công việc đó không thể xác định ngay từ lúc đầu và chỉ có thể xác định tại thời điểm runtime
 */
interface Vehicle {
    public function paint();
}

class Moto implements Vehicle {
    public function paint()
    {
        // TODO: Implement paint() method.
        echo "paint moto";
    }

}

class Bicycle implements Vehicle {
    public function paint()
    {
        // TODO: Implement paint() method.
        echo "paint bicycle";
    }

}

abstract class PaintManager {
    abstract protected function makeVehicle(): Vehicle; //return Vehicle instance

    public function takePaintedVehicle() {
        $vehicle = $this->makeVehicle();
        $vehicle->paint();
    }
}

class MotoManager extends PaintManager {
    protected function makeVehicle(): Vehicle
    {
        // TODO: Implement makeVehicle() method.
        return new Moto();
    }
}

class BicycleManager extends PaintManager {
    protected function makeVehicle(): Vehicle
    {
        // TODO: Implement makeVehicle() method.
        return new Bicycle();
    }
}

$moto = new MotoManager();
$moto->takePaintedVehicle();

$bicycle = new BicycleManager();
$bicycle->takePaintedVehicle();
