<?php
class ArrayList implements ListInterface {
    private $elements;
    private $size;

    public function __construct() {
        $this->elements = array(); // Menggunakan array PHP
        $this->size = 0;
    }

    public function add($element) {
        $this->elements[] = $element;
        $this->size++;
        return true;
    }

    public function addAt($index, $element) {
        if ($index < 0 || $index > $this->size) {
            throw new OutOfBoundsException("Index: $index, Size: {$this->size}");
        }
        
        array_splice($this->elements, $index, 0, [$element]);
        $this->size++;
    }

    public function get($index) {
        if ($index < 0 || $index >= $this->size) {
            throw new OutOfBoundsException("Index: $index, Size: {$this->size}");
        }
        return $this->elements[$index];
    }

    public function set($index, $element) {
        if ($index < 0 || $index >= $this->size) {
            throw new OutOfBoundsException("Index: $index, Size: {$this->size}");
        }
        $oldValue = $this->elements[$index];
        $this->elements[$index] = $element;
        return $oldValue;
    }

    public function removeAt($index) {
        if ($index < 0 || $index >= $this->size) {
            throw new OutOfBoundsException("Index: $index, Size: {$this->size}");
        }
        $removedElement = $this->elements[$index];
        array_splice($this->elements, $index, 1);
        $this->size--;
        return $removedElement;
    }

    public function remove($element) {
        $index = $this->indexOf($element);
        if ($index >= 0) {
            $this->removeAt($index);
            return true;
        }
        return false;
    }

    public function contains($element) {
        return in_array($element, $this->elements, true);
    }

    public function indexOf($element) {
        $index = array_search($element, $this->elements, true);
        return $index !== false ? $index : -1;
    }

    public function size() {
        return $this->size;
    }

    public function isEmpty() {
        return $this->size === 0;
    }

    public function clear() {
        $this->elements = array();
        $this->size = 0;
    }

    public function toArray() {
        return $this->elements;
    }

    public function __toString() {
        return "[" . implode(", ", $this->elements) . "]";
    }
}
?>
