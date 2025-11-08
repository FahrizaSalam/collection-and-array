<?php
class LinkedList implements ListInterface {
    private $nodes;  
    private $head;   
    private $tail;   
    private $size;
    private $nextIndex;

    public function __construct() {
        $this->nodes = array();
        $this->head = -1;
        $this->tail = -1;
        $this->size = 0;
        $this->nextIndex = 0;
    }

    private function createNode($data, $next = -1, $prev = -1) {
        $node = array(
            'data' => $data,
            'next' => $next,
            'prev' => $prev
        );
        $index = $this->nextIndex++;
        $this->nodes[$index] = $node;
        return $index;
    }

    public function add($element) {
        $newIndex = $this->createNode($element);
        
        if ($this->isEmpty()) {
            $this->head = $this->tail = $newIndex;
        } else {
            $this->nodes[$this->tail]['next'] = $newIndex;
            $this->nodes[$newIndex]['prev'] = $this->tail;
            $this->tail = $newIndex;
        }
        $this->size++;
        return true;
    }

    public function addAt($index, $element) {
        if ($index < 0 || $index > $this->size) {
            throw new OutOfBoundsException("Index: $index, Size: {$this->size}");
        }

        if ($index === $this->size) {
            return $this->add($element);
        }

        $newIndex = $this->createNode($element);

        if ($index === 0) {
            $this->nodes[$newIndex]['next'] = $this->head;
            if ($this->head !== -1) {
                $this->nodes[$this->head]['prev'] = $newIndex;
            }
            $this->head = $newIndex;
            if ($this->tail === -1) {
                $this->tail = $newIndex;
            }
        } else {
            $currentIndex = $this->getNodeIndex($index);
            $prevIndex = $this->nodes[$currentIndex]['prev'];
            
            $this->nodes[$newIndex]['next'] = $currentIndex;
            $this->nodes[$newIndex]['prev'] = $prevIndex;
            $this->nodes[$prevIndex]['next'] = $newIndex;
            $this->nodes[$currentIndex]['prev'] = $newIndex;
        }
        $this->size++;
    }

    public function get($index) {
        $nodeIndex = $this->getNodeIndex($index);
        return $this->nodes[$nodeIndex]['data'];
    }

    public function set($index, $element) {
        $nodeIndex = $this->getNodeIndex($index);
        $oldValue = $this->nodes[$nodeIndex]['data'];
        $this->nodes[$nodeIndex]['data'] = $element;
        return $oldValue;
    }

    public function removeAt($index) {
        $nodeIndex = $this->getNodeIndex($index);
        $node = $this->nodes[$nodeIndex];
        
        if ($node['prev'] === -1) {
            $this->head = $node['next'];
        } else {
            $this->nodes[$node['prev']]['next'] = $node['next'];
        }

        if ($node['next'] === -1) {
            $this->tail = $node['prev'];
        } else {
            $this->nodes[$node['next']]['prev'] = $node['prev'];
        }

        $data = $node['data'];
        unset($this->nodes[$nodeIndex]);
        $this->size--;
        return $data;
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
        return $this->indexOf($element) >= 0;
    }

    public function indexOf($element) {
        $currentIndex = $this->head;
        $position = 0;

        while ($currentIndex !== -1) {
            if ($this->nodes[$currentIndex]['data'] === $element) {
                return $position;
            }
            $currentIndex = $this->nodes[$currentIndex]['next'];
            $position++;
        }
        return -1;
    }

    private function getNodeIndex($position) {
        if ($position < 0 || $position >= $this->size) {
            throw new OutOfBoundsException("Index: $position, Size: {$this->size}");
        }

        $currentIndex = $this->head;
        for ($i = 0; $i < $position; $i++) {
            $currentIndex = $this->nodes[$currentIndex]['next'];
        }
        return $currentIndex;
    }

    public function size() {
        return $this->size;
    }

    public function isEmpty() {
        return $this->size === 0;
    }

    public function clear() {
        $this->nodes = array();
        $this->head = -1;
        $this->tail = -1;
        $this->size = 0;
        $this->nextIndex = 0;
    }

    public function toArray() {
        $result = array();
        $currentIndex = $this->head;
        while ($currentIndex !== -1) {
            $result[] = $this->nodes[$currentIndex]['data'];
            $currentIndex = $this->nodes[$currentIndex]['next'];
        }
        return $result;
    }

    public function __toString() {
        return "[" . implode(", ", $this->toArray()) . "]";
    }
}
?>
