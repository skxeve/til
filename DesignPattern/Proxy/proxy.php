<?php
/**
 * 表示用モデルクラス
 */
class Item
{
    private $id;
    private $name;

    public function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function toString()
    {
        return sprintf('%02d:%s', $this->id, $this->name);
    }
}

/**
 * Proxyするインターフェース
 **/
interface ItemDao {
    public function get($itemId);
}

/**
 * Proxyされるクラスその１
 **/
class ConstItemDao implements ItemDao
{
    const ITEM_ARRAY = [
        'りんご',
        'ごりら',
        'らんどせる',
        'るすばんでんわ',
    ];

    public function get($itemId)
    {
        if (array_key_exists($itemId, self::ITEM_ARRAY)) {
            $item = new Item($itemId, self::ITEM_ARRAY[$itemId]);
        } else {
            $item = new Item($itemId, '存在しないアイテム');
        }
        return $item;
    }
}

/**
 * Proxyされるクラスその２
 **/
class MockItemDao implements ItemDao
{
    public function get($itemId)
    {
        $item = new Item($itemId, 'ダミー' . $itemId);
        return $item;
    }
}

/**
 * ItemDaoを使うProxy
 **/
class ItemDaoProxy
{
    private $dao;
    private $cache;

    public function __construct(ItemDao $dao)
    {
        $this->dao = $dao;
        $this->cache = [];
    }

    public function get($itemId)
    {
        // Proxyで共通のキャッシュ処理を挟むことができる
        if (!array_key_exists($itemId, $this->cache)) {
            $this->cache[$itemId] = $this->dao->get($itemId);
        } else {
            echo 'Use cache item.' . $itemId . PHP_EOL;
        }

        return $this->cache[$itemId];
    }
}

/**
 * 処理開始
 */
if (($argv[1] ?? '') == 'mock') {
    $dao = new MockItemDao();
} else {
    $dao = new ConstItemDao();
}
$proxy = new ItemDaoProxy($dao);

foreach(range(1,2) as $loop) {
    echo '>>>>>Loop' . $loop . '<<<<<' . PHP_EOL;
    for ($i = 0; $i < 5; $i++) {
        $item = $proxy->get($i);
        echo $item->toString() . PHP_EOL;
    }
}
