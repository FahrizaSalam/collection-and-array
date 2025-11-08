<?php
class Stack implements CollectionInterface {
    private $elements;
    private $top;

    public function __construct() {
        $this->elements = array();
        $this->top = -1;
    }

    public function push($element) {
        $this->top++;
        $this->elements[$this->top] = $element;
    }

    public function pop() {
        if ($this->isEmpty()) {
            throw new RuntimeException("Stack is empty");
        }
        $element = $this->elements[$this->top];
        unset($this->elements[$this->top]);
        $this->top--;
        return $element;
    }

    public function peek() {
        if ($this->isEmpty()) {
            throw new RuntimeException("Stack is empty");
        }
        return $this->elements[$this->top];
    }

    public function add($element) {
        $this->push($element);
        return true;
    }

    public function remove($element) {
        $tempStack = array();
        $found = false;

        while (!$this->isEmpty()) {
            $current = $this->pop();
            if ($current === $element && !$found) {
                $found = true;
            } else {
                $tempStack[] = $current;
            }
        }

        while (!empty($tempStack)) {
            $this->push(array_pop($tempStack));
        }

        return $found;
    }

    public function contains($element) {
        return in_array($element, $this->elements, true);
    }

    public function size() {
        return $this->top + 1;
    }

    public function isEmpty() {
        return $this->top === -1;
    }

    public function clear() {
        $this->elements = array();
        $this->top = -1;
    }

    public function toArray() {
        return array_values($this->elements);
    }

    public function __toString() {
        return "Stack[" . implode(", ", array_reverse($this->toArray())) . "]";
    }
}
?>
