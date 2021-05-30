<?php
namespace App\Utils\Responses;

class IQQueueStatus{
    public int $id;
    public int $capacity;
    public bool $isFull;
    public function __construct(int $id, int $capacity,bool $isFull){
        $this->id = $id;
        $this->capacity = $capacity;
        $this->isFull = $isFull;
    }
}
?>
