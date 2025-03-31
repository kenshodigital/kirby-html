<?php declare(strict_types=1);

use Dom\HTMLDocument;
use Dom\XPath;

return function (string $contentType, string $html): string {
    if (in_array($contentType, ["htm", "html"])) {
        $doc = HTMLDocument::createFromString($html);
        $xpath = new XPath($doc);

        foreach ($xpath->query("//comment()") as $comment) {
            $comment->parentNode->removeChild($comment);
        }
        foreach ($xpath->query("//text()") as $text) {
            $text->textContent = trim($text->textContent);
        }
        $html = $doc->saveHTML();
    }
    return $html;
};
