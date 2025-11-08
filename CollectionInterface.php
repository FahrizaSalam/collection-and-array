?php
interface CollectionInterface {
    public function add($element);
    public function remove($element);
    public function contains($element);
    public function size();
    public function isEmpty();
    public function clear();
}
