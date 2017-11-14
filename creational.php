<?php
//CREATIONAL PATTERN

//simple factory
/*
 * Được dùng khi một đoạn code nào đó được sử dụng lại nhiều lần, tức là nó chỉ tạo ra một khuôn mẫu
 * sẵn cho việc thực hiện một câu việc nào đó, ta chỉ cần truyền vào các dữ liệu đầu vào và nhận được
 * kết quả trả về.
 */
//interface Door {
//    public function getWidth(): float;
//    public function getHeight(): float;
//}
//
//class WoodenDoor implements Door {
//    protected $width;
//    protected $height;
//
//    public function __construct($width, $height)
//    {
//        $this->width = $width;
//        $this->height = $height;
//    }
//
//    public function getHeight(): float
//    {
//        return $this->height;
//    }
//
//    public function getWidth(): float
//    {
//        return $this->width;
//    }
//}
//
//class DoorFactory {
//    public static function createDoor($width, $height): Door {
//        return new WoodenDoor($width, $height);
//    }
//}
//
//$woodenDoor = DoorFactory::createDoor(100, 200);
//echo "size of door: ".$woodenDoor->getHeight()." x ".$woodenDoor->getWidth();

//-------------------------------------------------------------------------
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
        echo "paint moto";
    }

}

class Bicycle implements Vehicle {
    public function paint()
    {
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
        return new Moto();
    }
}

class BicycleManager extends PaintManager {
    protected function makeVehicle(): Vehicle
    {
        return new Bicycle();
    }
}

$moto = new MotoManager();
$moto->takePaintedVehicle();

$bicycle = new BicycleManager();
$bicycle->takePaintedVehicle();

//----------------------------------------------------------------------
//Abstract factory
/*
 * Là dạng mở rộng của Simple Factory.
 *
 * Một factory chứa đựng một tập hợp các factory riêng lẻ nhưng các factory con đơn lẻ này độc lập
 * và có liên quan đến nhau mà không chỉ rõ các class cụ thể thực thi chúng
 */
/*
 * Trích wikipedia: The abstract factory pattern provides a way to encapsulate a group of individual
 * factories that have a common theme without specifying their concrete classes
 */
/*
 * Tiếp tục mở rộng ví dụ của Simple Factory
 */

//phan khai bao thong tin đến doi tuong door
interface Door {
    public function getDescription();
}

class WoodenDoor implements Door {
    public function getDescription()
    {
        echo "I am a woodendoor";
    }
}

class IronDoor implements Door {
    public function getDescription()
    {
        echo "I am an irondoor";
    }
}
//phần khai báo thông tin liên quan đến đói tượng thợ làm door
//interface khai bao thông tin thợ lắp cửa
interface DoorFittingExpert {
    public function getDescription();
}

//class thợ hàn chỉ để lắp của iron
class Welder implements DoorFittingExpert {
    public function getDescription()
    {
        echo "I am only fit iron door";
    }
}

//class thợ mộc chỉ có thể lắp cửa gõ
class Carpenter implements DoorFittingExpert {
    public function getDescription()
    {
        echo "I am only fit wooden door ";
    }
}

interface DoorFactory {
    public function makeDoor(): Door;
    public function makeFittingExpert(): DoorFittingExpert;
}

//tạo class khơi tao và gộp đối tượng loại cửa và đối tượng thợ sửa của với nhau
class WoodenDoorFactory implements DoorFactory {
    public function makeDoor(): Door
    {
        return new WoodenDoor();
    }

    public function makeFittingExpert(): DoorFittingExpert
    {
        return new Carpenter();
    }
}

class IronDoorFactory implements DoorFactory {
    public function makeDoor(): Door
    {
        return new IronDoor();
    }

    public function makeFittingExpert(): DoorFittingExpert
    {
        return new Welder();
    }

}

$ironFactory = new IronDoorFactory();
$ironDoor = $ironFactory->makeDoor();
$welder = $ironFactory->makeFittingExpert();
echo "<br>Thông tin iron door: ";
$ironDoor->getDescription();
echo "<br>Thông tin thợ hàn: ";
$welder->getDescription();
/*
 * ==> ta thấy được Wooden Door Factory bao bọc carpenter và wooden door bên trong nó, trong khi
 * Iron Door Factory bao bọc iron door và welder bên trong nó.
 * ===> Nó giúp đảm bảo rằng mỗi khi đối tượng Door được tạo thì nó luôn đi kèm với đối tượng
 * người lắp tương ứng -> tránh bị lỗi
 */
/*
 * Factory loại này được dùng khi có các thành phần riêng lẻ liên quan đến nhau và có thể gộp
 * lại thành một nhóm
 */