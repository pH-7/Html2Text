<?php
/**
 * @author    Pierre-Henry Soria <hi@ph7.me>
 * @license   MIT License; <https://opensource.org/licenses/MIT>
 */

declare(strict_types=1);

namespace PH7\HtmlToText;

use DOMDocument;

class Convert
{
    private const ENCODING = 'utf-8';

    private const ALLOWED_TAGS = '<p><br><li>';
    private const CLEAR_TAGS_PATTERN = '/<[^>]*>/';

    private string $htmlCode;
    private string $plainText;

    public function __construct(string $htmlCode)
    {
        $this->htmlCode = $htmlCode;

        $this->convertHtmlEntities();

        $oDom = new DOMDocument();
        $oDom->loadHTML($this->htmlCode);
        $this->htmlCode = trim($oDom->textContent);

        $this->parse();
    }

    private function parse(): void
    {
        $this->plainText = strip_tags($this->htmlCode, self::ALLOWED_TAGS);
        $this->plainText = preg_replace(self::CLEAR_TAGS_PATTERN, PHP_EOL, $this->plainText);
    }

    private function convertHtmlEntities(): void
    {
        $this->htmlCode = str_replace('&nbsp;', ' ', $this->htmlCode);
        $this->htmlCode = html_entity_decode($this->htmlCode, ENT_QUOTES | ENT_COMPAT , self::ENCODING);
        $this->htmlCode = html_entity_decode($this->htmlCode, ENT_HTML5, self::ENCODING);
        $this->htmlCode = html_entity_decode($this->htmlCode);
        $this->htmlCode = htmlspecialchars_decode($this->htmlCode);
    }

    public function getText(): string
    {
        return $this->plainText;
    }
}
