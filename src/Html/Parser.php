<?php

namespace Jra\Html;

class Parser {

    private $result = [];

    public function parse($html) {
        $document = new \DOMDocument();
        // Warningが出るので@で抑制
        @$document->loadHTML($html);
        $tableNodes = $document->documentElement->getElementsByTagName('table');
        foreach($tableNodes as $tableNode) {
            $th = $tableNode->getElementsByTagName('th')->item(0);
            if($th === null) continue;
            $date = $th->nodeValue;
            var_dump($date);
            $this->parseTable($tableNode, $date);
        }

        $xpath = new \DOMXPath($document);
    }

    public function parseTable($tableNode, $date = null) {
        $tdNodes = $tableNode->getElementsByTagName('td');
        foreach($tdNodes as $tdNode) {
            if($tdNode->getAttribute('class') === 'kaisaiBtn') {
                $a = $tdNode->getElementsByTagName('a')->item(0);
                if($a === null) continue;
                $onClickStr = $a->getAttribute('onclick');
                $matches = [];
                preg_match(
                    "#doAction\('.+','(.+)'\)#",
                    $onClickStr,
                    $matches);
                if(isset($matches[1])) {
                    $place = $tdNode->nodeValue;
                    $cname = $matches[1];
                    $this->setKaisaiButton($date, $place, $cname);
                    // $button = new KaisaiButton($place, $cname);
                }
            }
        }
    }

    private function setKaisaiButton($date, $place, $cname) {
        if(!isset($this->result[$date])) {
            $this->result[$date] = [];
        }
        $this->result[$date][$place] = $cname;
    }

    public function getResult() {
        return $this->result;
    }
}
