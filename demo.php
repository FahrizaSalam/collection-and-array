<?php
echo "========== DEMO STRUKTUR DATA DENGAN ARRAY ==========\n\n";

// Demo ArrayList
echo "=== ARRAYLIST (Array) ===\n";
$arrayList = new ArrayList();
$arrayList->add("Java");
$arrayList->add("Python");
$arrayList->add("C++");
echo "ArrayList: " . $arrayList . "\n";
echo "Get index 1: " . $arrayList->get(1) . "\n";
echo "Contains Python: " . ($arrayList->contains("Python") ? "true" : "false") . "\n";
$arrayList->remove("Python");
echo "Setelah hapus Python: " . $arrayList . "\n\n";

// Demo LinkedList
echo "=== LINKEDLIST (Array of Nodes) ===\n";
$linkedList = new LinkedList();
$linkedList->add(10);
$linkedList->add(20);
$linkedList->add(30);
echo "LinkedList: " . $linkedList . "\n";
$linkedList->addAt(1, 15);
echo "Setelah tambah 15 di index 1: " . $linkedList . "\n";
echo "Size: " . $linkedList->size() . "\n\n";

// Demo Stack
echo "=== STACK (Array) ===\n";
$stack = new Stack();
$stack->push("Buku 1");
$stack->push("Buku 2");
$stack->push("Buku 3");
echo "Stack: " . $stack . "\n";
echo "Pop: " . $stack->pop() . "\n";
echo "Peek: " . $stack->peek() . "\n";
echo "Stack sekarang: " . $stack . "\n\n";

// Demo Queue
echo "=== QUEUE (Array) ===\n";
$queue = new Queue();
$queue->offer("Orang 1");
$queue->offer("Orang 2");
$queue->offer("Orang 3");
echo "Queue: " . $queue . "\n";
echo "Poll: " . $queue->poll() . "\n";
echo "Peek: " . $queue->peek() . "\n";
echo "Queue sekarang: " . $queue . "\n\n";

// Demo HashMap
echo "=== HASHMAP (Array of Buckets) ===\n";
$hashMap = new HashMap();
$hashMap->put("Alice", 90);
$hashMap->put("Bob", 85);
$hashMap->put("Charlie", 95);
echo "HashMap: " . $hashMap . "\n";
echo "Nilai Bob: " . $hashMap->get("Bob") . "\n";
echo "Contains key Alice: " . ($hashMap->containsKey("Alice") ? "true" : "false") . "\n";
$hashMap->remove("Alice");
echo "Setelah hapus Alice: " . $hashMap . "\n";
echo "Keys: [" . implode(", ", $hashMap->keys()) . "]\n";

?>
