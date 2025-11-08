<?php
class Queue implements QueueInterface {
    private $elements;
    private $front;
    private $rear;
    private $size;

    public function __construct() {
        $this->elements = array();
        $this->front = 0;
        $this->rear = -1;
        $this->size = 0;
    }

    public function offer($element) {
        return $this->add($element);
    }

    public function poll() {
        if ($this->isEmpty()) {
            return null;
        }
        $element = $this->elements[$this->front];
        unset($this->elements[$this->front]);
        $this->front++;
        $this->size--;
        
        // Reset indices jika queue kosong
        if ($this->isEmpty()) {
            $this->front = 0;
            $this->rear = -1;
        }
        
        return $element;
    }

    public function peek() {
        if ($this->isEmpty()) {
            return null;
        }
        return $this->elements[$this->front];
    }

    public function add($element) {
        $this->rear++;
        $this->elements[$this->rear] = $element;
        $this->size++;
        return true;
    }

    public function remove($element) {
        $tempQueue = new Queue();
        $found = false;

        while (!$this->isEmpty()) {
            $current = $this->poll();
            if ($current === $element && !$found) {
                $found = true;
            } else {
                $tempQueue->offer($current);
            }
        }

        while (!$tempQueue->isEmpty()) {
            $this->offer($tempQueue->poll());
        }

        return $found;
    }

    public function contains($element) {
        return in_array($element, $this->elements, true);
    }

    public function size() {
        return $this->size;
    }

    public function isEmpty() {
        return $this->size === 0;
    }

    public function clear() {
        $this->elements = array();
        $this->front = 0;
        $this->rear = -1;
        $this->size = 0;
    }

    public function toArray() {
        return array_values($this->elements);
    }

    public function __toString() {
        return "Queue[" . implode(", ", $this->toArray()) . "]";
    }
}
?>
