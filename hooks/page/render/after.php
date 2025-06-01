<?php declare(strict_types=1);

use Dom\HTMLDocument;
use Dom\Node;
use Dom\XPath;

return function (string $contentType, string $html): string {
	if (in_array(needle: $contentType, haystack: ['htm', 'html'])) {
		$document = HTMLDocument::createFromString(source: $html);
		$xpath = new XPath(document: $document);

		foreach ($xpath->query(expression: '//comment()') as $comment) {
			/**
			 * Removes comments.
			 *
			 * @var Node $comment
			 */
			$comment->parentNode->removeChild(child: $comment);
		}
		foreach ($xpath->query(expression: '//text()') as $text) {
			/**
			 * Removes whitespace around text nodes.
			 *
			 * @var Node $text
			 */
			$text->textContent = trim(string: $text->textContent);
		}
		$html = $document->saveHTML();
	}
	return $html;
};
