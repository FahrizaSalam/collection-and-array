<?php
class HashMap implements MapInterface {
    private $buckets;
    private $capacity;
    private $size;

    public function __construct($capacity = 16) {
        $this->capacity = $capacity;
        $this->buckets = array_fill(0, $capacity, array());
        $this->size = 0;
    }

    private function hash($key) {
        if (is_string($key)) {
            return abs(crc32($key) % $this->capacity);
        }
        return abs(intval($key) % $this->capacity);
    }

    public function put($key, $value) {
        $index = $this->hash($key);
        $bucket = &$this->buckets[$index];

        // Cek apakah key sudah ada
        foreach ($bucket as &$entry) {
            if ($entry['key'] === $key) {
                $oldValue = $entry['value'];
                $entry['value'] = $value;
                return $oldValue;
            }
        }

        // Tambah entry baru
        $bucket[] = array('key' => $key, 'value' => $value);
        $this->size++;
        return null;
    }

    public function get($key) {
        $index = $this->hash($key);
        $bucket = $this->buckets[$index];

        foreach ($bucket as $entry) {
            if ($entry['key'] === $key) {
                return $entry['value'];
            }
        }
        return null;
    }

    public function remove($key) {
        $index = $this->hash($key);
        $bucket = &$this->buckets[$index];

        foreach ($bucket as $i => $entry) {
            if ($entry['key'] === $key) {
                $value = $entry['value'];
                array_splice($bucket, $i, 1);
                $this->size--;
                return $value;
            }
        }
        return null;
    }

    public function containsKey($key) {
        $index = $this->hash($key);
        $bucket = $this->buckets[$index];

        foreach ($bucket as $entry) {
            if ($entry['key'] === $key) {
                return true;
            }
        }
        return false;
    }

    public function size() {
        return $this->size;
    }

    public function isEmpty() {
        return $this->size === 0;
    }

    public function clear() {
        $this->buckets = array_fill(0, $this->capacity, array());
        $this->size = 0;
    }

    public function keys() {
        $keys = array();
        foreach ($this->buckets as $bucket) {
            foreach ($bucket as $entry) {
                $keys[] = $entry['key'];
            }
        }
        return $keys;
    }

    public function values() {
        $values = array();
        foreach ($this->buckets as $bucket) {
            foreach ($bucket as $entry) {
                $values[] = $entry['value'];
            }
        }
        return $values;
    }

    public function __toString() {
        $result = "{";
        $first = true;

        foreach ($this->buckets as $bucket) {
            foreach ($bucket as $entry) {
                if (!$first) {
                    $result .= ", ";
                }
                $result .= $entry['key'] . "=" . $entry['value'];
                $first = false;
            }
        }
        $result .= "}";
        return $result;
    }
}
?>
