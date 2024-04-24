<?php
namespace Parser;

class FoodParser {
    const CARD_PATTERN = "//div[@class='item-list__section']";
    const TITLE_PATTEN = ".//span[contains(@class,'item__title')]";
    const PRICE_PATTERN = ".//span[contains(@class,'item__price')]";
    const PIC_PATTERN = ".//span[contains(@class,'item__img')]/attribute::style";
    const DESCRIPTION_PATTERN = ".//span[contains(@class,'item__text')]//p";

    private $finder;

    public function __construct($finder)
    {
        $this->finder = $finder;
    }

    public function parseFoods()
    {
        $result = [];
        $items = $this->parseItems();

        foreach ($items as $item) {
            $itemData = [];

            $itemData['title'] = $this->parseTitle($item);
            $itemData['price'] = $this->parsePrice($item);
            $itemData['pic'] = $this->parsePic($item);
            $itemData['description'] = $this->parseDescription($item);

            $result[] = $itemData;
        }

        return $result;
    }

    private function parseItems()
    {
        return $this->finder->query(self::CARD_PATTERN);
    }

    private function parseTitle($item)
    {
        $title = $this->finder->query(self::TITLE_PATTEN, $item);
        return $title->item(0)->nodeValue ?? '';
    }

    private function parsePrice($item)
    {
        $price = $this->finder->query(self::PRICE_PATTERN, $item);
        $price = $price->item(0)->nodeValue;
        $price = (int) (explode('.', $price)[0] ?? 0);
        return $price;
    }

    private function parsePic($item)
    {
        $pic = $this->finder->query(self::PIC_PATTERN, $item);
        $pic = ($pic->item(0)->value ?? '');

        $pic = \preg_replace('#background-image: url\((\'|")(.*?)(\'|")\);#',"$2", $pic);

        return $pic ?? '';
    }

    private function parseDescription($item)
    {
        $text = $this->finder->query(self::DESCRIPTION_PATTERN, $item);
        $text = ($text->item(0)->nodeValue ?? '');
        return $text;
    }
}
?>