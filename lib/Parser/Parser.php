<?php
namespace Parser;

class Parser {
    private $targetUrl = null;
    public function __construct($targetSite)
    {
        $this->targetSite = $targetSite;
    }

    private function prepareUrl($url)
    {
        if (\stripos($url, $this->targetSite) === 0) {
            return $url;
        } else {
            return $this->targetSite . $url;
        }
    }

    private function getRawHtml($url)
    {
        $url = $this->prepareUrl($url);

        $output = curl_init();
        curl_setopt($output, CURLOPT_URL, $url);
        curl_setopt($output, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($output, CURLOPT_HEADER, 0);
        $out = curl_exec($output);
        curl_close($output);

        return $out;
    }

    public function getFoodData($url)
    {
        $html = $this->getRawHtml($url);

        libxml_use_internal_errors(true);
        $dom = new \DOMDocument;
        $dom->loadHTML($html);
        libxml_use_internal_errors(false);

        $finder = new \DomXPath($dom);

        $foodParser = new FoodParser($finder);

        $foodData = $foodParser->parseFoods();

        return $foodData;
    }


}
?>